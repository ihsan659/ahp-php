<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Raspberry</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <table id="tableAnggota" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ProductName</th>
                    <th>Category</th>
                    <th>ProductDescription</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Raspberry Pi</td>
                    <td>Raspberry Pi</td>
                    <td>Raspberry Pi</td>
                    <td>Raspberry Pi</td>
                    <td>Raspberry Pi</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="javascript/main.js?v=<?= date('YmdHis') ?>"></script>
<script type="text/javascript" src="javascript/anggota.js?v=<?= date('YmdHis') ?>"></script>
</html>