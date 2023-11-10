<?php
  class EventManager extends Model
  {
      // Fonction permettant d'avoir tout les events de la BDD
      public function getAllEvents()
      {
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Events LEFT JOIN Users ON Events.id_U = Users.id_U INNER JOIN Category ON Events.id_Cat = Category.id_Cat ORDER BY dateEvent_E ASC');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      public function getFuturEvents()
      {
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Events LEFT JOIN Users ON Events.id_U = Users.id_U INNER JOIN Category ON Events.id_Cat = Category.id_Cat WHERE Events.dateEvent_E > NOW() ORDER BY dateEvent_E ASC');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      // Récupère touts les event déjà passés
      public function getAllPastEvents()
      {
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Events LEFT JOIN Users ON Events.id_U = Users.id_U INNER JOIN Category ON Events.id_Cat = Category.id_Cat WHERE Events.dateEvent_E < NOW() ORDER BY dateEvent_E ASC');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      // Fonction permettant d'avoir quatres events (pour l'accueil)
      public function getFourEvents()
      {
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Events ORDER BY dateEvent_E ASC LIMIT 4');
          $req->execute();
          $datas = $req->fetchAll(PDO::FETCH_OBJ);
          return $datas;
      }
      // Récupère le nombre de participants à un événement
      public function getNumberParticipants($id_E)
      {
          $var = [];
          $bdd = $this->getBdd();
          $req = $bdd->prepare('SELECT * FROM Registered WHERE id_E = :id_E');
          $req->bindValue(':id_E', $id_E, PDO::PARAM_INT);
          $req->execute();
          $numberParticipants = $req->rowCount();
          return $numberParticipants;
      }
      // Fonction permettant d'avoir tout les events de la BDD
      public function getEvent($id)
      {
        $this->getBdd();
        return $this->getWithId('Events', 'Event', $id);
      }
      // Création d'un évévement
      public function createEvent() {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare("INSERT INTO Events (`title_E`, `image_E`, `shortContent_E`, `longContent_E`,`dateEvent_E`, `creationDate_E`, `id_U`, `id_Cat`)
            VALUES (:title_E, :image_E, :shortContent_E, :longContent_E, :dateEvent_E, :creationDate_E, :id_U, :id_Cat)");
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_E', $_POST['title'], PDO::PARAM_STR);
            // On mets une fausse valeur à image_id que l'on changera après par le chemin de l'image contenant l'id de l'event
            // On ne peux avoir l'id de l'event s'il n'est pas encore crée
            $request->bindValue(':image_E', 'aChanger', PDO::PARAM_STR);
            $request->bindValue(':shortContent_E', $_POST['shortContent'], PDO::PARAM_STR);
            $request->bindValue(':longContent_E', $_POST['longContent'], PDO::PARAM_STR);
            $request->bindValue(':dateEvent_E', $_POST['dateEvent'] . ' ' . $_POST['hourEvent'] . ':00', PDO::PARAM_STR);
            $request->bindValue(':creationDate_E', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id_U', $_SESSION['id_U'], PDO::PARAM_INT);
            $request->bindValue(':id_Cat', $_POST['category'], PDO::PARAM_INT);

            if ($request->execute()) {
                $targetFile = basename($_FILES["image"]["name"]);
                // $imageFileType = extention du fichier envoyé (jpg, png, ...)
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                // On récupère l'identifiant de la dernière ligne insérée
                $lastId = $bdd->lastInsertId();
                // Corresponds au chemin de l'image (ex : uploads/event1.png)
                $fileName = 'uploads/event' . $lastId . '.' . $imageFileType;
                $request2 = $bdd->prepare("UPDATE Events SET `image_E` = :fileName WHERE id_E = $lastId");
                $request2->bindValue(':fileName', $fileName, PDO::PARAM_STR);
                if ($request2->execute()) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $fileName);
                }
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function updateEvent($id){
        try {
            $bdd = $this->getBdd();
            // On récupère les données de l'event id_E = $id
            $event = $this->getWithId('Events', 'Event', $id);

            // Et si on a upload une nouvelle image
            $targetFile = basename($_FILES["image"]["name"]);
            // $imageFileType = extention du fichier envoyé (jpg, png, ...)
            $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
            // Corresponds au chemin de l'image (ex : uploads/event1.png)
            $fileName = 'uploads/event' . $id. '.' . $imageFileType;

            $request = $bdd->prepare('UPDATE `Events` SET
                `title_E` = :title_E,
                `image_E` = :image_E,
                `shortContent_E` = :shortContent_E,
                `longContent_E` = :longContent_E,
                `dateEvent_E` = :dateEvent_E,
                `modifDate_E` = :modifDate_E,
                `id_Cat` = :id_Cat
                WHERE `id_E` = :id_E');
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':title_E', $_POST['title'], PDO::PARAM_STR);
            $request->bindValue(':image_E', !empty($_FILES['image']["name"]) ? $fileName : $event->image(), PDO::PARAM_STR);
            $request->bindValue(':shortContent_E', $_POST['shortContent'], PDO::PARAM_STR);
            $request->bindValue(':longContent_E', $_POST['longContent'], PDO::PARAM_STR);
            $request->bindValue(':dateEvent_E', $_POST['dateEvent'] . ' ' . $_POST['hourEvent'] . ':00', PDO::PARAM_STR);
            $request->bindValue(':modifDate_E', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->bindValue(':id_Cat', $_POST['category'], PDO::PARAM_INT);
            $request->bindValue(':id_E', $id, PDO::PARAM_INT);
            // Exécution de la requête SQL
            if($request->execute()){
              if (!empty($_FILES['image']["name"])) {
                  // On supprimer l'ancienne image (évite les doublons, ex : event1.jpg event1.png)
                  unlink($event->image());
                  // Puis on déplace la nouvelle image
                  move_uploaded_file($_FILES["image"]["tmp_name"], $fileName);
              }
            }
        }
        catch(PDOException $e) {
            echo $sql . " " . $e->getMessage();
        }
      }

      public function deleteEvent($id){
        $this->getBdd();
        $this->delete('Events', $id);
      }
  }
