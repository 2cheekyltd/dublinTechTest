# Affiliate Invitation Application

This Laravel application reads a list of affiliates from a file, calculates the distance from a given location, and identifies affiliates within a specified distance range to invite for an event. The results are displayed in a sorted HTML table.

## Table of Contents

-   [Installation](#installation)
-   [Usage](#usage)
-   [Testing](#testing)
-   [File Structure](#file-structure)
-   [Distance Calculation](#distance-calculation)
-   [Troubleshooting](#troubleshooting)
-   [Support](#support)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-repo/affiliate-invitation.git
    cd affiliate-invitation
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Copy the example environment file and set your environment variables:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Set up your environment:**

Ensure your `.env` file has the correct configurations, particularly for the database if needed. For this task, no database is required.

5. **Prepare the affiliates data file:**

Ensure that the `affiliates.txt` file is placed in the `storage/app` directory. This file should contain JSON-encoded affiliate data, one record per line.

## Usage

Start the Laravel development server:

    ```bash
    php artisan serve
    ```

    Visit the application at http://localhost:8000/invite-affiliates to view the list of affiliates invited for the event.

## Testing

Run the test suite to ensure the application is working correctly:

    ```bash
    php artisan test
    ```

## File Structure

    •   Controllers: Contains the AffiliateController which handles reading data, filtering based on distance, and passing the results to the view.
    •	Views: Blade templates, including affiliates.blade.php, are used for rendering the results.
    •	Tests: Unit and feature tests are located in the tests directory, focusing on the main functionality of the application.

## Distance Calculation

The distance between the office and each affiliate is calculated using the Haversine formula. This formula provides the distance between two points on the Earth’s surface, given their latitude and longitude in degrees.

    ```bash
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)

    {
    $earthRadius = 6371; // Earth radius in kilometers

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $latDifference = $lat2 - $lat1;
        $lonDifference = $lon2 - $lon1;

        $a = sin($latDifference / 2) * sin($latDifference / 2) +
            cos($lat1) * cos($lat2) *
            sin($lonDifference / 2) * sin($lonDifference / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;

    }

    ```

## Troubleshooting

    •	No affiliates are displayed: Check that affiliates.txt is correctly placed in storage/app and contains valid JSON.
    •	Incorrect distances: Verify the GPS coordinates and the Haversine formula implementation.
    •	Development server issues: Ensure your environment and dependencies are set up correctly, and that no conflicting services are running.

## Support

For further assistance, please feel free to contact me on the e-mail address or phone number used in my application.

```

```
