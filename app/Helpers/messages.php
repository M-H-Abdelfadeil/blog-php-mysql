<script>
     let notifier = new AWN({
            position : "top-right",
            durations :{
                global: 3000,
            }
        });
</script>

<?php
if($success){
    ?>
        <script>
            notifier.success("<?php echo $success ?>")
        </script>
    <?php
}
if(isset($errors)){
    
    ?>
    <script>
        notifier.alert("<?php echo end($errors) ?>")
    </script>
<?php
}