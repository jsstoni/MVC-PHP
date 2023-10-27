<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->e($title); ?></title>
    <link rel="stylesheet" href="<?= $this->asset('/css/app.css') ?>" />
    <style>
        <?= $this->section('css'); ?>
    </style>
</head>

<body>
    <?= $this->section('content'); ?>
    <script>
        <?= $this->section('js'); ?>
    </script>
</body>

</html>