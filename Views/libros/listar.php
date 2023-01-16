<?= $header ?>

<h1 class="text-center my-5">Lista de libros</h1>
<a href="<?= base_url('crear')?>" class="btn btn-primary mb-3">Crear libro</a>
<table class="table table-dark table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($libros as $libro){?>
        <tr>
            <td><?=$libro['id'];?></td>
            <td><?=$libro['nombre'];?></td>
            <td>
                <img src="<?=base_url()?>/uploadsImages/<?=$libro['imagen'];?>"
                    class="img-thumbnail" 
                    width="100" alt="">
            </td>
            <td>
                <a href="<?= base_url('editar/'.$libro['id'])?>" class="btn btn-warning">Editar</a>
                <a href="<?= base_url('eliminar/'.$libro['id'])?>" class="btn btn-danger">Borrar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?= $footer ?>