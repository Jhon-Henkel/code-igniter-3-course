
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="<?= base_url(); ?>public/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>public/js/ie10-viewport-bug-workaround.js"></script>
        <?php
        if (isset($scripts)) {
            foreach ($scripts as $script) {
                $src = base_url() . 'public/js/' . $script;
                echo  '<script src="' . $src . '"></script>';
            }
        }
        ?>
    </body>
</html>