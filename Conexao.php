<!-- <?php
class Conexao {
    private $servername = "localhost";
    private $username = "root";
    private $password = "Batata.2021";
    private $dbname = "api";
    private $conn;

    public function getConnection() {
        if (!$this->conn) {
            try {
                // Cria uma nova conexão PDO
                $dsn = "mysql:host={$this->servername};dbname={$this->dbname}";
                $this->conn = new PDO($dsn, $this->username, $this->password);

                // Configura o modo de erro para exceções
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Em caso de erro, exibe a mensagem de erro
                die("Erro na conexão com o banco de dados: " . $e->getMessage());
            }
        }

        return $this->conn;
    }
}
?> -->
