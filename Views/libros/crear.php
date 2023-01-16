<?= $header ?>
<h1 class='text-center my-5'>Crear nuevo libro</h1>


<a href="<?= base_url('listar')?>" class="btn btn-dark mb-3">Volver al inicio</a>

<div class="card text-start">
    <div class="card-body">
        <form method="post" action="<?=base_url('/save')?>"  enctype="multipart/form-data">

            <div class="mb-3">
                <label for="bookName">Nombre del libro:</label>
                <input type="text" value="<?=old('bookName')?>" name='bookName' id="nombre" class="form-control">
            </div>

            <div class="mb-3">
                <label for="image">Imagen:</label>
                <input type="file" name='image' id="imagen" class="form-control">
            </div>

            <button class="btn btn-success" type="submit">Guardar</button>
        </form>
    </div>
</div>


<?= $footer?>