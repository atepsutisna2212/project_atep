<?php
function helper()
{
    return "hello helper";
}

function formatDate($date)
{
    return date('d-M-Y', strtotime($date));
}

function notifError($all)
{
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <ul>
            <?php
            foreach ($all as $error) {
                echo "<li>$error</li>";
            }
            ?>
        </ul>
    </div>
<?php
}
