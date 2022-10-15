<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save-Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <div class="container">
        <h3 align="center">API to Database</h3><br />

        <?php
        session_start();
        $conn = new mysqli("localhost", "root", '', "json");
        $query = '';
        $table_data = '';

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://datausa.io/api/data?drilldowns=State&measures=Population&year=2020");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);


        $response = curl_exec($curl);
        curl_close($curl);
        $json =  json_decode($response, true);




        foreach ((array)$json as $object) : {


                foreach ((array)$object as $data) : {

                        if (

                            isset($data['ID State']) || isset($data['State']) || isset($data['ID Year']) || isset($data['Year'])
                            || isset($data['Population']) || isset($data['Slug State'])
                        ) {
                            $state = mysqli_real_escape_string($conn, $data['State']);
                            $checkmechanism = "SELECT State FROM api_datas WHERE State = '$state'";
                            $checkmechanism_run = mysqli_query($conn, $checkmechanism);

                            if (mysqli_num_rows($checkmechanism_run) > 0) {
                                $_SESSION['message'] = "Data Already Exists!!";
                                header("Location: new3.php");
                                exit(0);
                            } else {
                                $id_state = mysqli_real_escape_string($conn, $data['ID State']);
                                $state = mysqli_real_escape_string($conn, $data['State']);
                                $id_year = mysqli_real_escape_string($conn, $data['ID Year']);
                                $year = mysqli_real_escape_string($conn, $data['Year']);
                                $population = mysqli_real_escape_string($conn, $data['Population']);
                                $slug_state = mysqli_real_escape_string($conn, $data['Slug State']);



                                $query .= "INSERT INTO api_datas(ID_State,State,ID_Year,Year,Population,Slug_State) VALUES('$id_state', '$state', '$id_year', '$year', '$population', '$slug_state'); ";  // Make Multiple Insert Query
                                $table_data .= '<tr>
					    <td>' . $data['ID State'] . '</td>
					    <td>' . $data['State'] . '</td>
					    <td>' . $data['ID Year'] . '</td>
					    <td>' . $data['Year'] . '</td>
					    <td>' . $data['Population'] . '</td>
					    <td>' . $data['Slug State'] . '</td>
					</tr>';
                            }
                        }
                    }
                endforeach;
            }

        endforeach;



        if (mysqli_multi_query($conn, $query)) //Run Mutliple Insert Query

        {
            echo '<h3 class="alert alert-success">Data Saved Successfully!</h3><br />';
            echo '
            <table class="table table-bordered">
                <tr>
                    <th>ID State</th>
                    <th>State</th>
                    <th>ID Year</th>
                    <th>Year</th>
                    <th>Population</th>
                    <th>Slug State</th>
                </tr>
                ';
            echo $table_data;
            echo '</table>';
        } else {
            echo "ERROR EXPERIENCE DURING TABLE CREATION" . $conn->connect_error;
        }
        ?>
        <br />
    </div>

</body>

</html>