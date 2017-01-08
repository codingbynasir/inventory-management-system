<p class="text-center well well-sm" style="margin:0;">&copy; - <?php echo date('Y'); ?> inventory system. All right reserved.</p>
<?php require 'require/script.php'; ?>
<script>
	$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
</body>
</html>