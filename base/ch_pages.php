<?php
if (isset($_GET['page'])) {
    $destino = "/TecnoInfo/";
    $page = $_GET['page'];
    switch ($_GET['page']) {

        // CASOS "NORMAIS"

        case 'home':
            header("Location: ../home.php");
            exit;
            break;


        //  SISTEMA DE CADASTRO
        case 'opc_cadastro':
            header("Location:" . $destino . "processos/cadastro/opc_cadastro.php");
            exit;
            break;

        case 'cadastro_adm':
            header("Location: cadastro_adm.php");
            exit;
            break;

        case 'cadastro_aluno_ue':
            header("Location: cadastro_aluno_ue.php");
            exit;
            break;

        // PROCESSAMENTO DO CADASTRO
        case 'cadastro_process_alu_ue':
            include "cadastro_process_alu_ue.php";
            break;

        case 'cadastro_process_adm':
            include "cadastro_process_adm.php";
            break;

        // FIM DO SISTEMA DE CADASTRO

        //  SISTEMA DE LOGIN
        case 'login':
            header("Location: processos\login\login.php");
            exit;
            break;

        // PROCESSAMENTO DE LOGIN

        case 'login_process':
            include "../processos/login/login_process.php";
            break;
        //  FIM DO SISTEMA DE LOGIN


        // RELATÓRIOS
        case "relListALU":
            include "../sis/aluno/relAlu.php";
            break;

        case "listarUsu":
            include "../sis/usuario/listarUsu.php";
            break;

        case "verUsu":
            include "../sis/usuario/verUsu.php";
            break;

        case "deleteUsu":
            include "../sis/usuario/deleteUsu.php";
            break;

        case "relUsu":
            header("Location: ../sis/usuario/relUsu.php");
            exit;
            break;

        case 'dash_relatorio':
            header("Location: dash/dashboard.php?page=relatorio");
            exit;
            break;

        case 'relatorio':
            include 'relatorio.php';
            break;

        // ALUNO

        case 'home-perfil':
            header("Location: dash/dashboard.php?page=perfil");
            exit;
            break;

        case 'perfil':
            include "perfil.php";
            break;

        case 'editPerfil':
            include "../sis/perfil/editPerfil.php";
            break;
        case 'editProcess':
            include "../sis/perfil/processar_edicao.php";
            break;

        case 'addAlu':
            include "../sis/aluno/add_alu.php";
            break;
        case 'delAlu':
            include "../sis/aluno/delete.php";
            break;
        case 'editarAlu':
            include "../sis/aluno/editarAlu.php";
            break;
        case 'inserirAlu':
            include "../sis/aluno/inserirAlu.php";
            break;
        case 'listarAlu':
            include "../sis/aluno/listar_alu.php";
            break;
        case 'updateAlu':
            include "../sis/aluno/updateAlu.php";
            break;
        case 'verAlu':
            include "../sis/aluno/verAlu.php";
            break;

        // ADM
        case 'addAdm':
            include "../sis/adm/addAdm.php";
            break;
        case 'deleteAdm':
            include "../sis/adm/delete.php";
            break;
        case 'editarAdm':
            include "../sis/adm/editarAdm.php";
            break;
        case 'inserirAdm':
            include "../sis/adm/inserirAdm.php";
            break;
        case 'listarAdm':
            include "../sis/adm/listarAdm.php";
            break;
        case 'updateAdm':
            include "../sis/adm/updateAdm.php";
            break;
        case 'verAdm':
            include "../sis/adm/verAdm.php";
            break;
        case 'relAdm':
            header("Location: ../sis/adm/relAdm.php");
            exit;
            break;

        // UE

        case 'addUni':
            include "../sis/unidade/addUni.php";
            break;
        case 'deleteUe':
            include "../sis/unidade/delete.php";
            break;
        case 'editarUni':
            include "../sis/unidade/editarUni.php";
            break;
        case 'inserirUni':
            include "../sis/unidade/inserirUni.php";
            break;
        case 'listarUni':
            include "../sis/unidade/listarUni.php";
            break;
        case 'updateUni':
            include "../sis/unidade/updateUni.php";
            break;
        case 'verUni':
            include "../sis/unidade/verUni.php";
            break;
        case "relUni":
            header("Location: ../sis/unidade/relUni.php");
            exit;
            break;


        // PROFESSOR

        case 'addTutor':
            include "../sis/tutor/addTutor.php";
            break;
        case 'deleteTutor':
            include "../sis/tutor/delete.php";
            break;
        case 'editarTutor':
            include "../sis/tutor/editarTutor.php";
            break;
        case 'inserirTutor':
            include "../sis/tutor/inserirTutor.php";
            break;
        case 'listarTutor':
            include "../sis/tutor/listarTutor.php";
            break;
        case 'updateTutor':
            include "../sis/tutor/updateTutor.php";
            break;
        case 'verTutor':
            include "../sis/tutor/verTutor.php";
            break;
        case 'relTutor':
            header("Location: ../sis/tutor/relTutor.php");
            exit;
            break;


        //TURMAS


        case 'addTurma':
            include "../sis/turma/addTurma.php";
            break;
        case 'deleteTurma':
            include "../sis/turma/delete.php";
            break;
        case 'editarTurma':
            include "../sis/turma/editarTurma.php";
            break;
        case 'inserirTurma':
            include "../sis/turma/inserirTurma.php";
            break;
        case 'listarTurma':
            include "../sis/turma/listarTurma.php";
            break;
        case 'updateTurma':
            include "../sis/turma/updateTurma.php";
            break;
        case 'verTurma':
            include "../sis/turma/verTurma.php";
            break;
        case "relTurma":
            header("Location: ../sis/turma/relTurma.php");
            exit;
            break;

        //CURSOS

        case 'addCurso':
            include "../sis/curso/addCurso.php";
            break;
        case 'deleteCurso':
            include "../sis/curso/delete.php";
            break;
        case 'editarCurso':
            include "../sis/curso/editarCurso.php";
            break;
        case 'inserirCurso':
            include "../sis/curso/inserirCurso.php";
            break;
        case 'listarCurso':
            include "../sis/curso/listarCurso.php";
            break;
        case 'updateCurso':
            include "../sis/curso/updateCurso.php";
            break;
        case 'verCurso':
            include "../sis/curso/verCurso.php";
            break;
        case 'addFav':
            include "../sis/fav/add_fav.php.php";
            break;
            case 'relatorioCursos';
            include "../sis/tutor/relCursos.php";
            break;
        case 'relCurso';
            header ("Location: ../sis/curso/relCurso.php");
            exit;
            break;

        // TELA DE AULA DO CURSO

        case 'curso':
            include "../sis/curso/verCurso.php";
            break;
        case 'meuscursos':
            include "../sis/aluno/curso/meuscursos.php";
            break;

        //  CERTIFICADO

        case 'certificado';
        header ("Location: ../sis/curso/certificado.php");
        exit;
        break;

        //MÓDULOS

        case 'addMod':
            include "../sis/modulo/addMod.php";
            break;
        case 'deleteMod':
            include "../sis/modulo/delete.php";
            break;
        case 'editarMod':
            include "../sis/modulo/editarMod.php";
            break;
        case 'inserirMod':
            include "../sis/modulo/inserirMod.php";
            break;
        case 'listarMod':
            include "../sis/modulo/listarMod.php";
            break;
        case 'updateMod':
            include "../sis/modulo/updateMod.php";
            break;
        case 'verMod':
            include "../sis/modulo/verMod.php";
            break;

        //AULAS

        case 'addAula':
            include "../sis/Aula/addAula.php";
            break;
        case 'deleteAula':
            include "../sis/Aula/delete.php";
            break;
        case 'editarAula':
            include "../sis/Aula/editarAula.php";
            break;
        case 'inserirAula':
            include "../sis/Aula/inserirAula.php";
            break;
        case 'listarAula':
            include "../sis/Aula/listarAula.php";
            break;
        case 'updateAula':
            include "../sis/Aula/updateAula.php";
            break;
        case 'verAula':
            include "../sis/Aula/verAula.php";
            break;

        //PLANOS

        case 'addPlano':
            include "../sis/Plano/addPlano.php";
            break;
        case 'deletePlano':
            include "../sis/Plano/delete.php";
            break;
        case 'editarPlano':
            include "../sis/Plano/editarPlano.php";
            break;
        case 'inserirPlano':
            include "../sis/Plano/inserirPlano.php";
            break;
        case 'listarPlano':
            include "../sis/Plano/listarPlano.php";
            break;
        case 'updatePlano':
            include "../sis/Plano/updatePlano.php";
            break;
        case 'verPlano':
            include "../sis/Plano/verPlano.php";
            break;

        //AVALIAÇÕES

        case 'addAv':
            include "../sis/Avaliacao/addAv.php";
            break;
        case 'deleteAv':
            include "../sis/Avaliacao/delete.php";
            break;
        case 'editarAv':
            include "../sis/Avaliacao/editarAv.php";
            break;
        case 'inserirAv':
            include "../sis/Avaliacao/inserirAv.php";
            break;
        case 'listarAv':
            include "../sis/Avaliacao/listarAv.php";
            break;
        case 'updateAv':
            include "../sis/Avaliacao/updateAv.php";
            break;
        case 'verAv':
            include "../sis/Avaliacao/verAv.php";
            break;
        // case 'inserirResp':
        //     include "../sis/avaliacao/inserirResp.php";

        //PAGAMENTOS
        case 'addPag':
            include "../sis/pagamento/addPag.php";
            break;
        case 'deletePag':
            include "../sis/pagamento/delete.php";
            break;
        case 'editarPag':
            include "../sis/pagamento/editarPag.php";
            break;
        case 'inserirPag':
            include "../sis/pagamento/inserirPag.php";
            break;
        case 'listarPag':
            include "../sis/pagamento/listarPag.php";
            break;
        case 'updatePag':
            include "../sis/pagamento/updatePag.php";
            break;
        case 'verPag':
            include "../sis/pagamento/verPag.php";
            break;
            case 'processarPagamento':
                include "../sis/pagamento/processarPagamento.php";
                break;
        case 'relPag':
            header ("Location: ../sis/pagamento/relPag.php");
            exit;
            break;


       

        case 'index':
            header("Location: /TecnoInfo/index.php");
            exit;
            break;
        case 'logout':
            include "processos/logout.php";
            break;
    }
}


