<?php
require_once('header.php');



try {
    $statement = $conn->prepare("SELECT property.*, 
            locations.name as location_name, 
            types.name as types_name, 
            GROUP_CONCAT(amenities.name) as amenity_names
        FROM property
        JOIN locations ON property.location_id = locations.id 
        JOIN types ON property.type_id = types.id
        JOIN amenities ON FIND_IN_SET(amenities.id, property.amenities)
        WHERE property.agent_id=? 
        GROUP BY property.id
        ORDER BY property.id DESC");

    $statement->execute([$_SESSION['agents']['id']]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Debugging: Check the number of rows fetched
    echo "Number of rows fetched: " . count($result) . "<br>";

    // Output results in a table format
    if (count($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Type</th>
                <th>Amenities</th>
              </tr>";

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['types_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['amenity_names']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No properties found for this agent.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
