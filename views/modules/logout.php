<?php
if (isset($_SESSION['user_type_id'])) {
    session_destroy();
    echo '<script>
    window.location="authentication";
</script>';
} else {
    echo '<script>
    window.location="authentication";
</script>';
}
