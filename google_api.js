<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
    function handleCredentialResponse(response) {
      console.log("Encoded JWT ID token: " + response.credential);
    }
    window.onload = function () {
      google.accounts.id.initialize({
        client_id: "792949497631-fbkfjrq3pdjfk4gqphi7730s8t250ll9.apps.googleusercontent.com",
        callback: handleCredentialResponse
      });
      google.accounts.id.renderButton(
        document.getElementById("buttonDiv"),
        { theme: "outline", size: "large" }  // customization attributes
      );
      google.accounts.id.prompt(); // also display the One Tap dialog
    }
</script>
