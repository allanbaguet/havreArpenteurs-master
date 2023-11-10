<?php

class RegisteredManager extends Model
{
    // Fonction permettant d'avoir toutes les inscriptions de la BDD
    public function getAllRegistered() {
        // On appel la méthode afin de ce connecter à la BDD
        $this->getBdd();
        // On récupère les données de la table Registered dans des objets de type Registered
        return $this->getAll('Registered', 'Registered');
    }
    // Fonction permettant un enregistrement de la BDD en fonction de la BDD
    public function getRegistered($id) {
        // On appel la méthode afin de ce connecter à la BDD
        $this->getBdd();
        // On récupère les données de l'events d'id_E = $id
        return $this->getWithId('Registered', 'Registered', $id);
    }
    public function getEventRegistered($id_E) {
        $bdd = $this->getBdd();
        $request = $bdd->prepare("SELECT * FROM Registered WHERE id_E = :id_E");
        $request->bindValue(':id_E', $id_E, PDO::PARAM_INT);
        $request->execute();
        $registered = $request->fetchAll(PDO::FETCH_OBJ);
        return $registered;
    }
    public function createRegistered($id_E) {
        try {
            $bdd = $this->getBdd();
            $request = $bdd->prepare("INSERT INTO Registered (`id_U`, `id_E`, `date_R`)
            VALUES (:id_U, :id_E, :date_R)");
            // On associe les valeurs aux différents paramètres de la requête SQL
            $request->bindValue(':id_U', $_SESSION['id_U'], PDO::PARAM_INT);
            $request->bindValue(':id_E', $id_E, PDO::PARAM_INT);
            $request->bindValue(':date_R', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $request->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    public function deleteRegistered($id_U, $id_E) {
        try {
            $bdd = $this->getBdd();
            $req = $bdd->prepare('DELETE FROM `Registered` WHERE id_U = :id_U AND id_E = :id_E');
            $req->bindValue(':id_U', $id_U, PDO::PARAM_INT);
            $req->bindValue(':id_E', $id_E, PDO::PARAM_INT);
            $req->execute();
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
