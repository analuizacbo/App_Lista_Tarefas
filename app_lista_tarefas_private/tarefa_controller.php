<?php
    //Precisa prestar atenção a onde o require será executado, neste caso, acontece dentro do dir publico pois, quem vai chamá-lo é o arq tarefa_controller.php publico, portanto precisamos subir 2 níveis para acessar o diretório privado 
    require "../../app_lista_tarefas/tarefa.model.php";
    require "../../app_lista_tarefas/tarefa.service.php";
    require "../../app_lista_tarefas/conexao.php";

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $acao = isset($_GET['acao']) ? ($_GET['acao']) : $acao;
    //echo $acao;

    if($acao == 'inserir'){
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa',$_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');

    } else if($acao == 'recuperar'){
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefas = $tarefaService->recuperar();
    } else if($acao == 'atualizar'){
        //echo 'Estamos aqui';
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id'])
                ->__set('tarefa', $_POST['tarefa']);//quando setamos o retorno do metodo set o proprio objeto pode só acessar ele e passar os valores. Passando outro atributo para ser atualizado 

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        if( $tarefaService->atualizar()){

            if($_GET['pag'] && $_GET['pag'] == 'index'){
                header('Location: index.php');
            }else{
                header('Location: todas_tarefas.php');
            }
        }
    } else if($acao == 'remover'){
        //echo 'entramos aqui';
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->remover();
        
        if($_GET['pag'] && $_GET['pag'] == 'index'){
            header('Location: index.php');
        }else{
            header('Location: todas_tarefas.php');
        }
    } else if($acao == 'marcarRealizada'){
        $tarefa = new Tarefa();
        $tarefa->__set('id',$_GET['id'])
                -> __set('id_status',2);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();

        if($_GET['pag'] && $_GET['pag'] == 'index'){
            header('Location: index.php');
        }else{
            header('Location: todas_tarefas.php');
        }

    } else if($acao == 'recuperarTarefasPendentes'){
        $tarefa = new Tarefa();
        $tarefa->__set('id_status',1);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao,$tarefa);
        $tarefas = $tarefaService->recuperarTarefasPendentes();
    }

    // echo '<pre>';
    // print_r($tarefaService);
    // echo '</pre>';
?>