<?= $header?>
<h1 class='text-center my-5'>Editar libro</h1>


<a href="<?= base_url('listar')?>" class="btn btn-dark mb-3">Volver al inicio</a>

<div class="card text-start">
    <div class="card-body">
        <form method="post" action="<?=base_url('/edit')?>"  enctype="multipart/form-data">

            <input type="hidden" value="<?=$libro['id']?>" name="id">

            <div class="mb-3">
                <label for="bookName">Nombre del libro:</label>
                <input type="text" value="<?= $libro['nombre']?>" name='bookName' id="nombre" class="form-control">
            </div>

            <div class="mb-3">
                <label for="image">Cambiar imagen:</label>
                <input type="file" name='image' id="imagen" class="form-control">
            </div>
            <div class= "mb-3">
                <img src="<?=base_url()?>/uploadsImages/<?=$libro['imagen'];?>"
                    class="img-thumbnail" 
                    width="400px" alt="">
            </div>

            <button class="btn btn-success" type="submit">Guardar</button>
        </form>
    </div>
</div>
<?= $footer?>