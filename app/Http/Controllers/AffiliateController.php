<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    // Coordinates of the Dublin office
    private $officeLatitude = 53.3340285;
    private $officeLongitude = -6.2535495;

    /**
     * Main method to invite affiliates within 100km.
     * 
     * This method loads affiliates, filters them based on distance,
     * and returns a view with the filtered list.
     */
    public function inviteAffiliates()
    {
        // Load all affiliates from the file
        $affiliates = $this->loadAffiliates();

        // Filter affiliates within 100km radius
        $nearbyAffiliates = $this->filterAffiliatesWithinRange($affiliates, 100);

        // Return the view with the filtered affiliates
        return view('affiliates', ['affiliates' => $nearbyAffiliates]);
    }

    /**
     * Load affiliates data from a file.
     * 
     * This method reads a JSON-encoded file where each line represents
     * an affiliate's data, and decodes it into an array.
     *
     * @return array An array of affiliates
     */
    private function loadAffiliates()
    {
        $file = storage_path('app/affiliates.txt');
        $affiliates = [];

        // Check if the file exists before reading
        if (file_exists($file)) {
            // Read each line and decode the JSON object
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            foreach ($lines as $line) {
                $affiliates[] = json_decode($line, true);
            }
        }

        return $affiliates;
    }

    /**
     * Filters affiliates within a specified distance from the office.
     * 
     * This method calculates the distance of each affiliate from the office
     * and filters those within the specified range. It also sorts the filtered
     * affiliates by their ID in ascending order.
     *
     * @param array $affiliates The list of affiliates to filter
     * @param float $range The maximum distance (in km) from the office
     * @return array The list of nearby affiliates sorted by ID
     */
    private function filterAffiliatesWithinRange($affiliates, $range)
    {
        $nearbyAffiliates = [];

        foreach ($affiliates as $affiliate) {
            // Calculate the distance to each affiliate
            $distance = $this->calculateDistance(
                $this->officeLatitude,
                $this->officeLongitude,
                $affiliate['latitude'],
                $affiliate['longitude']
            );

            // Include only affiliates within the specified range
            if ($distance <= $range) {
                // Store distance for display purposes
                $affiliate['distance'] = $distance;
                $nearbyAffiliates[] = $affiliate;
            }
        }

        // Sort the affiliates by their ID
        usort($nearbyAffiliates, function ($a, $b) {
            return $a['affiliate_id'] <=> $b['affiliate_id'];
        });

        return $nearbyAffiliates;
    }

    /**
     * Calculates the Great-circle distance between two points.
     * 
     * This method uses the Haversine formula to calculate the distance
     * between two geographical points specified by latitude and longitude.
     * 
     * @param float $lat1 Latitude of the first point
     * @param float $lon1 Longitude of the first point
     * @param float $lat2 Latitude of the second point
     * @param float $lon2 Longitude of the second point
     * @return float The distance between the two points in kilometers
     */
    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth radius in kilometers

        // Convert degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Calculate differences between coordinates
        $latDifference = $lat2 - $lat1;
        $lonDifference = $lon2 - $lon1;

        // Haversine formula to calculate the distance
        $a = sin($latDifference / 2) * sin($latDifference / 2) +
            cos($lat1) * cos($lat2) *
            sin($lonDifference / 2) * sin($lonDifference / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Return the distance in kilometers
        return $earthRadius * $c;
    }
}
