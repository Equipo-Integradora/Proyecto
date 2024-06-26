<?php 
    class database
    {
        private $PDOLocal;
        private $user = "admin";
        private $password = "1234";
        private $server = "mysql:host=localhost; dbname=sweet_beauty; charset=utf8";

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
           $result= $this->PDOLocal->query($cadena);
           return $result->fetch(PDO::FETCH_OBJ);
            
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
            $query = "SELECT * FROM usuarios WHERE email_usuario = '$usuario';";
            $consulta = $this->PDOLocal->query($query);

            while($renglon = $consulta->fetch(PDO::FETCH_ASSOC))
            {
                if(password_verify($contra, $renglon['contraseña_usuario']))
                {
                    $pase = true;
                    $datos=$renglon;
                    
                }
            }

            if($pase)
            {
                session_start();         
                $_SESSION["usuario"] = $datos['nombre_usuario'];
                $_SESSION["id"] = $datos['id_usuario'];
                $_SESSION["admin"] = false;
                if ($_SESSION["id"]=="0") {
                    $_SESSION["admin"] = true;
                }
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  imageUrl: 'https://i.postimg.cc/DyhkvCt7/logo2.png',";
                echo "imageWidth: 300,";
                echo "imageHeight: 130,";
                echo "imageAlt: 'Custom image',";
                echo "  title: 'Bienvenido " . $_SESSION["usuario"] . "',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                if($_SESSION["admin"])
                {
                    header("refresh:2, ../views/admin.php");
                }else
                {
                    unset($_SESSION["admin"]);
                    header("refresh:2, ../index.php");
                }
            }else
            {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Correo o Contraseña incorrecto',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2, ../views/login.php");
            }

        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }
       
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


        function CerrarSesion()
        {
            
             session_start();
             session_destroy();
              header("Location: ../index.php");

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

        function usr($cadena)
        {
            try
            {
                $result = $this->PDOLocal->query($cadena);
                return $result->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        function perfil()
        {
            $_SESSION["correo"] = 0;
            $_SESSION["contra"] = 0;
            $_SESSION["nombre"] = 0;
            $_SESSION["telfon"] = 0;
            $_SESSION["nacimi"] = 0;
            $_SESSION["sexo"] = 0;

        }
        function cambio( $passn, $usuario,$contra)
    {
        try
        {
            $pase=false;
            $query="SELECT * FROM usuarios WHERE id_usuario = '{$_SESSION["id"]}';";
            $consulta=$this->PDOLocal->query($query);

            while($renglon = $consulta->fetch(PDO::FETCH_ASSOC))
            {
                if(password_verify($contra,$renglon['contraseña_usuario']))
                {
                    $pase =true;
                }
            }
            if($pase)
            {
                $hash = password_hash($passn, PASSWORD_DEFAULT); 
                $con ="update usuarios 
                set
                contraseña_usuario='$hash'
                WHERE id_usuario = '{$_SESSION["id"]}';";
                $resultado = $this->ejecuta($con);

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'success',";
                echo "  title: 'Contraseña modificada',";
                echo "  showConfirmButton: false,";
                echo "  timer: 4000";
                echo "});";
                echo "</script>";
                header("refresh:2; ../views/perfil2.php");
            }
            else
            {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({";
                echo "  icon: 'error',";
                echo "  title: 'Datos incorrectos...',";
                echo "  showConfirmButton: false,";
                echo "  timer: 2000";
                echo "});";
                echo "</script>";
                header("refresh:2; ../views/perfil2.php");
            }



        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    function aleatorio() {
        $longitudCodigo = 7;
        $codigo = 'default';
        $caracteresPermitidos = '0123456789';
        $caracteresPermitidosLength = strlen($caracteresPermitidos);
    
        $consulta = "SELECT orden_venta.id_venta FROM orden_venta;";
        $resultado = $this->PDOLocal->query($consulta);
        $filas = $resultado->fetchAll(PDO::FETCH_OBJ);
        
        $codigoExistente = array();
        foreach ($filas as $fila) {
            $codigoExistente[] = $fila->id_venta;
        }
    
        $diferente = false;
        while (!$diferente) {
            $codigoGenerado = 'ORD';
            for ($i = 0; $i < $longitudCodigo; $i++) {
                $codigoGenerado .= $caracteresPermitidos[rand(0, $caracteresPermitidosLength - 1)];
            }
    
            if (!in_array($codigoGenerado, $codigoExistente) && $codigoGenerado !== 'default') {
                $diferente = true;
            }
        }
    
        return $codigoGenerado;
    }


    function ultimaid()
    {
        try
        {
            return $this->PDOLocal->lastInsertId();

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    function dias($query)
    {
            try {
                $stmt = $this->PDOLocal->query($query);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $shi = array();
        foreach ($resultados as $fila) {
            $shi[] = $fila['fecha_cita_registro_cita'];
        }
        return $shi;
            } catch (PDOException $e) {

                echo $e->getMessage();
            }   

    }

    function correos($query)
    {
            try {
                $stmt = $this->PDOLocal->query($query);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $shi = array();
        foreach ($resultados as $fila) {
            $shi[] = $fila['email_usuario'];
        }
        return $shi;
            } catch (PDOException $e) {

                echo $e->getMessage();
            }   

    }
    function duplas( $productoo, $colors) {
        $consulta = "SELECT COUNT(*) FROM detalle_productos WHERE detalle_producto_detalle_producto_FK=$productoo
        and color_detalle_producto_FK=$colors;";
        $stmt = $this->PDOLocal->prepare($consulta);
        $stmt->execute();
        $cantidad = $stmt->fetchColumn();
        
        return ($cantidad > 0);
    }
    function productdobl( $productor) {
        $consulta = "SELECT COUNT(*) FROM productos WHERE nombre_producto='$productor';";
        $stmt = $this->PDOLocal->prepare($consulta);
        $stmt->execute();
        $cantidad = $stmt->fetchColumn();
        
        
        return ($cantidad > 0);
    }
    function color( $color) {
        $consulta = "SELECT COUNT(*) FROM colores WHERE nombre_color='$color';";
        $stmt = $this->PDOLocal->prepare($consulta);
        $stmt->execute();
        $cantidad = $stmt->fetchColumn();
        return ($cantidad > 0);
        
    }


}


       
?>