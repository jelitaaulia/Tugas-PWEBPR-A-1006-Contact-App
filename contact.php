<?php
include 'database.php';

class Contact {
    protected static $conn;

    public static function initialize() {
        $db = new Database();
        self::$conn = $db->getConnection();
    }

    public static function select() {
        $sql = "SELECT * FROM contact_info";
        $result = self::$conn->query($sql);
        return $result;
    }

    public static function delete($id) {
        $stmt = self::$conn->prepare("DELETE FROM contact_info WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        
        if ($result) {
            return "Contact deleted successfully";
        } else {
            return "Error: Unable to delete contact";
        }
    }
}
?>
