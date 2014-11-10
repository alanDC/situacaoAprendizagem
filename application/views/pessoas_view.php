<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title><?php echo $titulo; ?></title>
        <meta charset="UTF-8" />
        <link type=”text/css” rel=”stylesheet” href=”<?php echo base_url(); ?>/assets/css/estilo.css”/>
    </head>
    <body>
        <?php echo form_open('pessoas/inserir', 'id="form-pessoas"'); ?>

        <label for="nome">Nome:</label><br/>
        <input type="text" name="nome" value="<?php echo set_value('nome'); ?>"/>
        <div class="error"><?php echo form_error('nome'); ?></div>
        
        <label for="email">Email:</label><br/>
        <input type="email" name="email" value="<?php echo set_value('email'); ?>"/>
        <div class="error"><?php echo form_error('email'); ?></div>
        
        <label for="idade">Idade:</label><br/>
        <input type="number" name="idade" value="<?php echo set_value('idade'); ?>"/>
        <div class="error"><?php echo form_error('idade'); ?></div>
        
        <label for="foto">Foto:</label><br/>
        <input type="text" name="foto" value="<?php echo set_value('foto'); ?>"/>
        <div class="error"><?php echo form_error('foto'); ?></div>
        
        <label for="senha">Senha:</label><br/>
        <input type="password" name="senha" value="<?php echo set_value('senha'); ?>"/>
        <div class="error"><?php echo form_error('senha'); ?></div>
        
        <input type="submit" name="cadastrar" value="Cadastrar" />   

        <?php echo form_close(); ?>

        <div id="grid-pessoas">
            <ul>
                <?php foreach ($pessoas as $pessoa): ?>
                    <li>
                        <a title="Deletar" href="<?php echo base_url() . 'pessoas/deletar/' . $pessoa->idusuario; ?>" onclick="return confirm('Confirma a exclusão deste registro?')"> X </a>
                        <span> - </span>
                        <a title="Editar" href="<?php echo base_url() . 'pessoas/editar/' . $pessoa->idusuario; ?>"><?php echo $pessoa->nome; ?></a>
                        <span> - </span>
                        <span><?php echo $pessoa->email; ?></span>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </body>
</html>

<!-- Código retirado de http://phpdojo.com.br/php/crud-completo-com-codeigniter-parte-ii/ -->
