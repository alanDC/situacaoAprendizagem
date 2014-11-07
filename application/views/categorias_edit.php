<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta charset="UTF-8" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilo.css"/>
    </head>
    <body>
        <?php echo form_open('categorias/atualizar', 'id="form-categorias"'); ?>

        <input type="hidden" name="idcategoria" value="<?php echo $dados_categoria[0]->idcategoria; ?>"/>

        <label for="categoria">Categoria:</label><br/>
        <input type="text" name="categoria" value="<?php echo $dados_categoria[0]->categoria; ?>"/>
        <div class="error"><?php echo form_error('categoria'); ?></div>

        <label for="descricao">Descrição:</label><br/>
        <input type="text" name="descricao" value="<?php echo $dados_categoria[0]->descricao; ?>"/>
        <div class="error"><?php echo form_error('descricao'); ?></div>
        
        
        <input type="submit" name="atualizar" value="Atualizar" />

        <?php echo form_close(); ?>
    </body>
</html>