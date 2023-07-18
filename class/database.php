<?php 
    class database
    {
        private $PDOLocal;
        private $user = "admin";
        private $password = "1234";
        private $server = "mysql:host=localhost:3309;dbname=sweet_beauty";
        function conectarDB()
        {
            try
            {
                $this->PDOLocal = new PDO($this->server, $this->user, $this->password);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function desconectarDB()
        {
            try
            {
                $this->PDOLocal = null;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function seleccionar($consulta)
        {
            try
            {
                $resultado = $this->PDOLocal->query($consulta);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
                return $fila;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function ejecuta($cadena)
    {
        try
        {
            $this->PDOLocal->query($cadena);
        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function verifica($usuario, $contra)
    {
        try
        {

            $pase = false;
            $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' OR email_usuario = '$usuario' OR telefono_usuario  = '$usuario';";
            $consulta = $this->PDOLocal->query($query);

            while($renglon = $consulta->fetch(PDO::FETCH_ASSOC))
            {
                if(password_verify($contra, $renglon['contraseña_usuario']))
                {
                    $pase = true;
                }
            }

            if($pase)
            {
                session_start();
                $_SESSION["usuario"] = $usuario;
                echo "<div class='alert alert-succes'>";
                echo "<h2 align='center'> Bienvenido ".$_SESSION["usuario"]."</h2>";
                echo "</div>";
                header("refresh:2, ../views/home.php");
            }else
            {
                echo "<div class='alert alert-danger'>";
                echo "<h2 aling='center'>Usuario o Password incorrectos</h2>";
                echo "</div>";
                header("refresh:2, ../views/login.php");
            }

        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
       
    }
    
    function CerrarSesion()
    {
        
            session_start();
            session_destroy();
            header("Location: ../views/home.php");

       
    }
    function cate($consulta1)
        {
            try
            {
                $resultado = $this->PDOLocal->query($consulta1);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
                return $fila;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function cate_pro($consulta1)
        {
            try
            {
                $resultado = $this->PDOLocal->query($consulta1);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
                return $fila;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function cat_tip($consulta2)
        {
            try
            {
                $resultado = $this->PDOLocal->query($consulta2);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
                return $fila;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function busca($consulta)
        {
            try
            {
                $resultado = $this->PDOLocal->query($consulta);
                $fila = $resultado->fetchAll(PDO::FETCH_OBJ);
                return $fila;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }


    
    }
?>