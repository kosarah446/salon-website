
$sql = "SELECT fname, lname, email, appointments.location_id AS location, appointments.category_id AS category,appointments.service_id AS service, comment
          FROM appointments
          JOIN locations
            ON locations.id = appointments.locations_id
          JOIN categories
            ON appointments.category_id = categories.id
          JOIN services
            ON appointments.service_id = services.id
          WHERE fname = " . $_GET['fname'] . ";";