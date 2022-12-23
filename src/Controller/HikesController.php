<?php

class HikesController
{
    private Hikes $hikesModel;

    public function __construct() {
    $this->hikesModel = new Hikes();
    }
    public function index(): void {
        $hikes = $this->hikesModel->findAll();
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/ListHikes.php';
        include 'View/includes/footer.view.php';
    }

    public function show(string $id): void {
        $hike = $this->hikesModel->find($id);
        if (empty($_SESSION['user'])) {
            include 'View/includes/header.view.php';
            echo "<div class='w-[50%] text-center'>";
            echo "You must be <a href='login?id=". $id ."'>logged in</a> to see this !<br>Get back <a href='/'>home</a>.";
            throw new Exception ("You must be logged in to see this page.");

        }
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/SingleHikes.php';
        include 'View/includes/footer.view.php';
    }

    public function showNewHike(): void {
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/newHike.view.php';
        include 'View/includes/footer.view.php';
    }

    public function createNewHike(array $input):void
    {
        try {
            if (empty($input['hikeName']) || empty($input['hikeDistance']) || empty($input['hikeDuration']) || empty($input['hikeElevation']) || empty($input['hikeDescription'])) {
                throw new Exception('Form data not validated.');
            }
            $hikeName = htmlspecialchars($input['hikeName']);
            $hikeDate = date("Y-n-j");
            $distance = htmlspecialchars($input['hikeDistance']);
            $duration = htmlspecialchars($input['hikeDuration']);
            $elevation = htmlspecialchars($input['hikeElevation']);
            $description = htmlspecialchars($input['hikeDescription']);
            $userid = $_SESSION['user']['id'];

            $this->hikesModel->create($hikeName, $hikeDate, $duration, $distance, $elevation, $description, $userid);

            $id = $this->hikesModel->getLastInsertId();

            http_response_code(302);
            header('location: /hike?id='.$id);
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
        }
    }

    public function editHike(string $id): void {
        $hike = $this->hikesModel->find($id);
        if (empty($_SESSION['user'])) {
            include 'View/includes/header.view.php';
            echo "<div class='w-[50%] text-center'>";
            echo "You must be <a href='login?id=". $id ."'>logged in</a> to see this !<br>Get back <a href='/'>home</a>.";
            throw new Exception ("You must be logged in to see this page.");

        }
        include 'View/includes/header.view.php';
        include 'View/includes/navbar.view.php';
        include 'View/editHike.view.php';
        include 'View/includes/footer.view.php';
    }

    public function updateHike(array $input):void
    {
        try {
            if (empty($input['hikeName']) || empty($input['hikeDistance']) || empty($input['hikeDuration']) || empty($input['hikeElevation']) || empty($input['hikeDescription'])) {
                throw new Exception('Form data not validated.');
            }
            $hikeName = htmlspecialchars($input['hikeName']);
            $distance = htmlspecialchars($input['hikeDistance']);
            $duration = htmlspecialchars($input['hikeDuration']);
            $elevation = htmlspecialchars($input['hikeElevation']);
            $description = htmlspecialchars($input['hikeDescription']);
            $updatedAt = date("Y-m-d H:i:s");
            $id = $_GET['id'];


            $this->hikesModel->update($hikeName, $distance, $duration, $elevation, $description, $updatedAt, $id);

            http_response_code(302);
            header('location: /');
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
        }
    }

    public function deleteHike(string $id) {
            $this->hikesModel->delete($id);
            http_response_code(302);
            header('location: /');
    }
}