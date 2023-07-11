    </script>
    <script src="<?php echo base_url('/assets/uswds/uswds/js/uswds.min.js'); ?>"></script>
    <script>
        window.addEventListener("offline", (event) => {
            console.log("The network connection has been lost.");
            document.getElementById("offline").style.display = "block";
            document.getElementById("online").style.display = "none";
        });

        window.addEventListener("online", (event) => {
            console.log("You are now connected to the network.");
            document.getElementById("offline").style.display = "none";
            document.getElementById("online").style.display = "block";
        });
    </script>    
</body>
</html>
