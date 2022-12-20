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
        include 'View/SingleHikes.php';
        include 'View/includes/footer.view.php';
    }

    public function showNewHike() {
        include 'View/includes/header.view.php';
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

            $this->hikesModel->create($hikeName, $hikeDate, $distance, $duration, $elevation, $description);

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