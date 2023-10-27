<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->e($title); ?></title>
    <link rel="stylesheet" href="<?= $this->asset('/css/app.css') ?>" />
</head>

<body>
    <?php echo $this->section('content'); ?>
</body>

</html>