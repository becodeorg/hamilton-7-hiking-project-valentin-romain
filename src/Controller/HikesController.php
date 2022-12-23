<?php

class HikesController
{
    private Hikes $hikesModel;

    public function __construct() {
    $this->hikesModel = new Hikes();
    }
    public function index(string|null $tagId, string|null $user): void {
        if(!empty($tagId)) {
            $hikes = $this->hikesModel->findAllByTag($tagId);
            include 'View/includes/header.view.php';
            include 'View/includes/navbar.view.php';
            include 'View/ListHikes.php';
            include 'View/includes/footer.view.php';
        }
        elseif(!empty($user)) {
            $hikes = $this->hikesModel->findAllBy($user);
            include 'View/includes/header.view.php';
            include 'View/includes/navbar.view.php';
            include 'View/ListHikes.php';
            include 'View/includes/footer.view.php';
        }
        else {
            $hikes = $this->hikesModel->findAll();
            include 'View/includes/header.view.php';
            include 'View/includes/navbar.view.php';
            include 'View/ListHikes.php';
            include 'View/includes/footer.view.php';
        }
    }

    public function show(string $id): void {
        $hike = $this->hikesModel->find($id);
        $tags = $this->hikesModel->findAllTags($id);
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
        $tags = $this->hikesModel->printAllTags();
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
            $tagsId = $input['tags'];

            $this->hikesModel->create($hikeName, $hikeDate, $duration, $distance, $elevation, $description, $userid);
            $id = $this->hikesModel->getLastInsertId();

            foreach ($tagsId as $tag_id) {
                $this->hikesModel->linkHikes($id, $tag_id);
            }

            http_response_code(302);
            header('location: /hike?id='.$id);
        } catch (Exception $e) {
            echo "Tags ID:";
            var_dump($input['tags']);
            echo"<br>Hike ID:" . $id . "<br>";
            echo $e->getMessage();
            echo "<br><a href='/'>Get back home</a>";
        }
    }

    public function editHike(string $id): void {
        $hike = $this->hikesModel->find($id);
        $tagsChecked = $this->hikesModel->findAllTags($id);
        if (empty($_SESSION['user'])) {
            include 'View/includes/header.view.php';
            echo "<div class='w-[50%] text-center'>";
            echo "You must be <a href='login?id=". $id ."'>logged in</a> to see this !<br>Get back <a href='/'>home</a>.";
            throw new Exception ("You must be logged in to see this page.");

        }
        $tags = $this->hikesModel->printAllTags();
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
            $tagsId = $input['tags'];

            $this->hikesModel->update($hikeName, $distance, $duration, $elevation, $description, $updatedAt, $id);
            foreach ($tagsId as $tag_id) {
                $this->hikesModel->updateLinkHikes($id, $tag_id);
            }
            http_response_code(302);
            header('location: /hike?id='.$id);
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