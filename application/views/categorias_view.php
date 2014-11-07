<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta charset="UTF-8" />
        <link type=”text/css” rel=”stylesheet” href=”<?php echo base_url(); ?>assets/css/estilo.css”/>
    </head>
    <body>
        <?php echo form_open('categorias/inserir', 'id="form-categorias"'); ?>

        <label for="categoria">Categoria:</label><br/>
        <input type="text" name="categoria" value="<?php echo set_value('categoria'); ?>"/>
        <div class="error"><?php echo form_error('categoria'); ?></div>
        <label for="descricao">Descrição:</label><br/>
        <input type="text" name="descricao" value="<?php echo set_value('descricao'); ?>"/>
        <div class="error"><?php echo form_error('descricao'); ?></div>
         <input type="submit" name="cadastrar" value="Cadastrar" />
        
        <?php echo form_close(); ?>
        <!-- Lista as Pessoas Cadastradas -->
        <div id="grid-categorias">

            <ul>
                <?php foreach ($categorias as $categoria): ?>
                    <li>
                        <a title="Deletar" href="<?php echo base_url() . 'categorias/deletar/' . $categoria->idcategoria; ?>" onclick="return confirm('Confirma a exclusão deste registro?')">X</a>
                        <span> - </span>
                        <a title="Editar" href="<?php echo base_url() . 'categorias/editar/' . $categoria->idcategoria; ?>"><?php echo $categoria->categoria; ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <!-- Fim Lista -->
    </body>
</html>