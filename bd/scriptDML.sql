use sitap;
select * from usuario;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sitap` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sitap` ;


-- -----------------------------------------------------
-- Data for table `sitap`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`usuario` (`idusuario`, `nome`, `email`, `idade`, `foto`, `senha`) VALUES (2, 'Utriusque coloris', 'Utriusque@hotmail.com', 17, '', 'utriusque123');
INSERT INTO `sitap`.`usuario` (`idusuario`, `nome`, `email`, `idade`, `foto`, `senha`) VALUES (0, 'Anônimo', 'anonimo@anonimo.com.br', 23, NULL, NULL);
INSERT INTO `sitap`.`usuario` (`idusuario`, `nome`, `email`, `idade`, `foto`, `senha`) VALUES (1, 'Admin', 'Admin@admin.com.br', 45, NULL, 'admin123');
INSERT INTO `sitap`.`usuario` (`idusuario`, `nome`, `email`, `idade`, `foto`, `senha`) VALUES (4, 'Serafim do Pulmão', 'serafim@gmail.com', 63, '', 'serafim123');

COMMIT;

-- -----------------------------------------------------
-- Data for table `sitap`.`artigo`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`artigo` (`idartigo`, `titulo`, `conteudo`, `data`, `usuario_idusuario`, `like`) VALUES (1, 'A Pizza nossa de cada dia nos dai hoje', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras porttitor vel nunc ac posuere. Curabitur aliquam, justo sit amet dapibus cursus, dui sem faucibus massa, et mollis est urna at leo. Curabitur aliquet nisi et diam sollicitudin vestibulum. Nulla molestie vestibulum dui in tristique. Mauris molestie vitae nisl a feugiat. Sed sit amet massa mauris. Etiam accumsan tincidunt est et commodo. Praesent non quam et dolor congue ultricies. Mauris sit amet pulvinar enim. Vestibulum pretium nibh vel gravida vulputate. Nunc convallis mollis lorem, sed condimentum diam. Etiam pellentesque odio id nulla molestie malesuada. Nulla in consectetur ipsum, in auctor ex. Morbi a odio lectus. In hac habitasse platea dictumst.</p>', '2014-10-27  16-50:35', 3, 15);
INSERT INTO `sitap`.`artigo` (`idartigo`, `titulo`, `conteudo`, `data`, `usuario_idusuario`, `like`) VALUES (2, 'O Bacon faz mal pro porco', '<p>Bacon ipsum dolor amet doner pork chop ham brisket. Bacon meatball meatloaf hamburger. Porchetta turkey leberkas, ball tip fatback sirloin beef ribs. Salami shoulder drumstick, chuck capicola filet mignon shankle ham ground round tri-tip frankfurter pork jowl.</p>', '2014-10-27 16-50:35', 3, 11);

COMMIT;

-- -----------------------------------------------------
-- Data for table `sitap`.`fotos`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`fotos` (`idfotos`, `nome`, `artigo_idartigo`) VALUES (1, 'http://lorempizza.com/i/714/300', 1);
INSERT INTO `sitap`.`fotos` (`idfotos`, `nome`, `artigo_idartigo`) VALUES (2, 'http://lorempizza.com/i/514/300', 1);
INSERT INTO `sitap`.`fotos` (`idfotos`, `nome`, `artigo_idartigo`) VALUES (3, 'http://baconmockup.com/300/200', 2);
INSERT INTO `sitap`.`fotos` (`idfotos`, `nome`, `artigo_idartigo`) VALUES (4, 'http://baconmockup.com/714/300', 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `sitap`.`categoria`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`categoria` (`idcategoria`, `categoria`, `descricao`) VALUES (1, 'Pizza', 'Categoria que fala sobre pizzas');
INSERT INTO `sitap`.`categoria` (`idcategoria`, `categoria`, `descricao`) VALUES (3, 'Bacon', 'Categoria que fala sobre Bacon');

COMMIT;

-- -----------------------------------------------------
-- Data for table `sitap`.`categoria_has_artigo`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`categoria_has_artigo` (`categoria_idcategoria`, `artigo_idartigo`) VALUES (1, 1);
INSERT INTO `sitap`.`categoria_has_artigo` (`categoria_idcategoria`, `artigo_idartigo`) VALUES (2, 2);

COMMIT;

-- -----------------------------------------------------
-- Data for table `sitap`.`comentario`
-- -----------------------------------------------------
START TRANSACTION;
USE `sitap`;
INSERT INTO `sitap`.`comentario` (`idcomentario`, `usuario_idusuario`, `artigo_idartigo`, `corpo`, `data`) VALUES (1, 0, 1, 'Hello That\'s a comment from anonymous, we never forget.', '2014-10-27 16-48:15');
INSERT INTO `sitap`.`comentario` (`idcomentario`, `usuario_idusuario`, `artigo_idartigo`, `corpo`, `data`) VALUES (2, 2, 1, 'Hello That\'s a comment from...Me...', '2014-10-27 16-48:30');

COMMIT;
