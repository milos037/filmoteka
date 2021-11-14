        <footer id="footer">
            <div class="text-center">
                <p>Miloš Mladenović M8-2020 <b> | </b>
                Razvoj aplikacija za Web - ASSŠ Trstenik &copy; <?php echo date('Y');?></p>
            </div>
        </footer>
        <script>
            //prevencija od RESUBMIT kada se refreshuje strana
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>