<?php
//gramatica
define('PROGRAMA', 0);
define('PROGRAMA_', 1);
define('LISTA_VAR', 2);
define('VARIAVEL', 3);
define('TIPO', 4);
define('BLOCO', 5);
define('COMANDO', 6);
define('PRINTA', 7);
define('ATRIBUICAO', 8);
define('EXP', 9);
define('EXP1', 10);
define('EXP2', 11);
define('EXP3', 12);
define('IFI', 13);
define('EXPLOG', 14);
define('OPERADOR_LOGICO', 15);

define('NAO_TERMINAIS', [
    PROGRAMA => '<PROGRAMA>',
    PROGRAMA_ => '<PROGRAMA\'>',
    LISTA_VAR => '<LISTA_VAR>',
    VARIAVEL => '<VAR>',
    TIPO => '<TIPO>',
    BLOCO => '<BLOCO>',
    COMANDO => '<COMANDO>',
    PRINTA => '<PRINT>',
    ATRIBUICAO => '<ATRIBUICAO>',
    EXP => '<EXP>',
    EXP1 => '<EXP1>',
    EXP2 => '<EXP2>',
    EXP3 => '<EXP3>',
    IFI => '<IF>',
    EXPLOG => '<EXPLOG>',
    OPERADOR_LOGICO => '<OPERADOR_LOGICO>',
]);

class SLR {
    private $afd;

    public function __construct() {
        $this->afd = array(
            //tabelas acao e goto
            0 => [
                'ACTION' => ['programa' => 'S 1'],
                'GOTO' => [PROGRAMA => 2],
            ],
            1 => [
                'ACTION' => ['id' => 'S 3'],
                'GOTO' => [LISTA_VAR => 4, VARIAVEL => 5, TIPO => 6],
            ],
            2 => [
                'ACTION' => ['$' => 'ACC'],
            ],
            3 => [
                'ACTION' => ['ap' => 'S 7'],
                'GOTO' => [EXP => 8, EXP2 => 9, EXP3 => 10],
            ],
            4 => [
                'ACTION' => ['ac' => 'S 11'],
            ],
            5 => [
                'ACTION' => ['v' => 'S 12', 'pv' => 'R 3 5', 'ac' => 'R 3 5'],
            ],
            6 => [
                'ACTION' => ['id' => 'S 13'],
            ],
            7 => [
                'ACTION' => ['int' => 'S 14', 'char' => 'S 15'],
                'GOTO' => [VARIAVEL => 16],
            ],
            8 => [
                'ACTION' => ['fp' => 'S 17'],
            ],
            9 => [
                'ACTION' => ['v' => 'R 3 7', 'pv' => 'R 3 7', 'ac' => 'R 3 7'],
                'GOTO' => [BLOCO => 18, COMANDO => 19, PRINTA => 20, ATRIBUICAO => 21, IFI => 22, EXPLOG => 23],
            ],
            10 => [
                'ACTION' => ['v' => 'R 3 9', 'pv' => 'R 3 9', 'ac' => 'R 3 9'],
                'GOTO' => [BLOCO => 24, COMANDO => 19, PRINTA => 20, ATRIBUICAO => 21, IFI => 22, EXPLOG => 23],
            ],
            11 => [
                'ACTION' => ['ac' => 'S 25'],
            ],
            12 => [
                'ACTION' => ['id' => 'S 26'],
            ],
            13 => [
                'ACTION' => ['v' => 'R 3 5', 'pv' => 'R 3 5', 'ac' => 'R 3 5'],
            ],
            14 => [
                'ACTION' => ['id' => 'S 27'],
            ],
            15 => [
                'ACTION' => ['id' => 'S 28'],
            ],
            16 => [
                'ACTION' => ['id' => 'S 29'],
            ],
            17 => [
                'ACTION' => ['v' => 'R 3 4', 'pv' => 'R 3 4', 'ac' => 'R 3 4'],
                'GOTO' => [BLOCO => 30, COMANDO => 19, PRINTA => 20, ATRIBUICAO => 21, IFI => 22, EXPLOG => 23],
            ],
            18 => [
                'ACTION' => ['fp' => 'R 4 5'],
            ],
            19 => [
                'ACTION' => ['ap' => 'S 7'],
                'GOTO' => [EXP => 31, EXP2 => 32, EXP3 => 33],
            ],
            20 => [
                'ACTION' => ['id' => 'S 34'],
            ],
            21 => [
                'ACTION' => ['id' => 'S 35'],
            ],
            22 => [
                'ACTION' => ['ap' => 'R 4 6', 'fp' => 'R 4 6'],
            ],
            23 => [
                'ACTION' => ['ap' => 'S 7'],
                'GOTO' => [EXP => 36, EXP2 => 32, EXP3 => 33],
            ],
            24 => [
                'ACTION' => ['v' => 'R 3 9', 'pv' => 'R 3 9', 'ac' => 'R 3 9'],
                'GOTO' => [BLOCO => 37, COMANDO => 19, PRINTA => 20, ATRIBUICAO => 21, IFI => 22, EXPLOG => 23],
            ],
            25 => [
                'ACTION' => ['v' => 'R 3 4', 'pv' => 'R 3 4', 'ac' => 'R 3 4'],
            ],
            26 => [
                'ACTION' => ['fp' => 'S 38'],
            ],
            27 => [
                'ACTION' => ['fp' => 'R 3 17', 'v' =>'S 7'],
            ],
            28 => [
                'ACTION' => ['v' => 'R 3 5', 'pv' => 'R 3 5', 'ac' => 'R 3 5'],
            ],
            29 => [
                'ACTION' => ['v' => 'R 3 4', 'pv' => 'R 3 4', 'ac' => 'R 3 4'],
            ],
            30 => [
                'ACTION' => ['fp' => 'R 4 5'],
                'GOTO' => [BLOCO => 17],
            ],
            31 => [
                'ACTION' => ['fp' => 'S 39'],
            ],
            32 => [
                'ACTION' => ['id' => 'S 40'],
            ],
            33 => [
                'ACTION' => ['fp' => 'R 4 6'],
            ],
            34 => [
                'ACTION' => ['fp' => 'S 41'],
            ],
            35 => [
                'ACTION' => ['v' => 'R 3 5', 'pv' => 'R 3 5', 'ac' => 'R 3 5'],
            ],
            36 => [
                'ACTION' => ['fp' => 'R 4 6'],
            ],
            37 => [
                'ACTION' => ['v' => 'R 3 9', 'pv' => 'R 3 9', 'ac' => 'R 3 9'],
            ],
            38 => [
                'ACTION' => ['fp' => 'R 4 5'],
            ],
            39 => [
                'ACTION' => ['id' => 'S 42'],
            ],
            40 => [
                'ACTION' => ['v' => 'R 3 4', 'pv' => 'R 3 4', 'ac' => 'R 3 4'],
            ],
            41 => [
                'ACTION' => ['id' => 'S 43'],
            ],
            42 => [
                'ACTION' => ['v' => 'R 3 5', 'pv' => 'R 3 5', 'ac' => 'R 3 5'],
            ],
            43 => [
                'ACTION' => ['v' => 'R 3 4', 'pv' => 'R 3 4', 'ac' => 'R 3 4'],
            ],
        );
    } 
    public function parser($entrada){
        $pilha = array();
        array_push($pilha,0);
        echo "\nPilha:".implode(' ',$pilha);
        $i = 0;
        while ($entrada){
            if (array_key_exists( $entrada[$i], $this->afd[end($pilha)]['ACTION']))
                $move = $this->afd[end($pilha)]['ACTION'][$entrada[$i]];
            else 
                return false;
            $acao = explode(' ',$move);
            echo " | Ação:".$move;
            switch($acao[0]){
                case 'S': 
                    array_push($pilha,$acao[1]);
                    $i++;
                    break;
                case 'R':  
                    for ($j = 0; $j<$acao[1]; $j++){
                        array_pop($pilha);
                    } 
                    
                    echo ' | Redução para '.NAO_TERMINAIS[$acao[2]];              
                    $desvio = $this->afd[end($pilha)]['GOTO'][$acao[2]][$entrada[$i]];
                    array_push($pilha,$desvio);
                    break;

                case 'ACC': // Accept
                    echo 'Ok';
                    return true;
                default:
                    echo 'Erro';
                    return false;
            }
            echo "\nPilha:".implode(' ',$pilha);
        }
    }
}

$sigma = array('a','b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y','z');
$num = array(0,1,2,3,4,5,6,7,8,9);
$tokens = [];

$delta = array('q0'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q67', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q1', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q28', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3',0 => 'q37', 1 => 'q37', 2 => 'q37', 3 => 'q37', 4 => 'q37', 5 => 'q37', 6 => 'q37', 7 => 'q37', 8 => 'q37', 9 => 'q37', '+' => 'q38', '-' => 'q40','*' => 'q42','/' => 'q43',';' => 'q44','>' => 'q45','<' => 'q47','!' => 'q49','^' => 'q51','(' => 'q52',')' => 'q53','[' => 'q54',']' => 'q55','{' => 'q56','}' => 'q57',',' => 'q66'),
              //if (2)
               'q1'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q2', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q71', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
               'q2'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              //identificador (3)
              'q3'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
             //PRINTA (32)
              'q28'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q29', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q29'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q30', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q60', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q30'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q31', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q31'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q32', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q32'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
             
             //ograma
              'q60'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q61', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q61'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q62', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q62'=>array('a'=>'q63', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q63'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q64', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q64'=>array('a'=>'q65', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
             //char
             'q67'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q68','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q68'=>array('a'=>'q69', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q64', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q69'=>array('a'=>'q5', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q70', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q70'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
             
             //int
             'q71'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q72', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
              'q72'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q3', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q3', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q3', 'q'=>'q3', 'r'=>'q70', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3', 0 => 'q3', 1 => 'q3', 2 => 'q3', 3 => 'q3', 4 => 'q3', 5 => 'q3', 6 => 'q3', 7 => 'q3', 8 => 'q3', 9 => 'q3'),
             

              //constante (37)
              'q37'=>array(0 => 'q37', 1 => 'q37', 2 => 'q37', 3 => 'q37', 4 => 'q37', 5 => 'q37', 6 => 'q37', 7 => 'q37', 8 => 'q37', 9 => 'q37'),
              //+ (38)
              'q38'=>array('+' => 'q39'),
              //- (40)
              'q40'=>array('-' => 'q41'),
              //(/) (43)
              'q43'=>array(), 
                //pv
              'q44'=>array(), 
              //> (45)
              'q45'=>array('=' => 'q46'), 
              //< (47)
              'q47'=>array('=' => 'q48'), 
              // ( (52)
              'q52'=>array(),
              // ) (53)
              'q53'=>array(),
              // { (56) 
              'q56'=>array(),
              // } (57)
              'q57'=>array(),
                //virgula
              'q66'=>array());

$Q = array('q0','q1', 'q2', 'q3','q32','q33','q34','q35','q36','q37','q38','q39','q40','q41','q42','q43','q44','q45','q46','q47','q48','q49','q50','q51','q52','q53','q54','q55','q56','q57','q60','q61','q62','q63','q64','q65','q66','q67','q68','q69','q70','q71','q72');

$q0 = 'q0';
$count = 0;
$pos1 = 0;
$pos2 = 0;

$finais = array('q2', 'q3','q32','q36','q37', 'q38', 'q39','q40','q41','q42', 'q43', 'q44','q45','q46','q47', 'q48', 'q50','q51','q52','q53', 'q54', 'q55','q56','q57','q58','q65','q66','q70','q72');

$palavra = (isset($_POST['entrada'])?$_POST['entrada']:""); 

echo "Palavra  atual: ".$palavra."<br>";

$array_palavra = explode(" ",$palavra);
$tam = count($array_palavra);

$estado = $q0;

for($j = 0; $j < $tam; $j++){
    for($i = 0; $i < strlen($array_palavra[$j]); $i++){
        $count++;
       
        $palavra_atual = $array_palavra[$j];
        $estado = $delta[$estado][$palavra_atual[$i]];

        if($i == 0){
            $pos1 = $count;
        }
        if($i == strlen($array_palavra[$j])-1){
            $pos2 = $count;
        }
    }
    

    if(in_array($estado,$finais)){
        // token , palavra,  pos1 , pos2
        $token = "";

        switch ($estado) {
            case 'q2':
                $token = "if";
                $tokens = $token;
                break;
            case 'q3':
                $token = "id";
                $tokens = $token;
                break;
            case 'q32':
                $token ="printa";
                $tokens = $token;
                break;
            case 'q37':
                $token ="const";
                $tokens = $token;
                break;
            case 'q38':
                $token ="mais";
                $tokens = $token;
                break;
            case 'q40':
                $token ="menos";
                $tokens = $token;
                break;
            case 'q43':
                $token ="barra";
                $tokens = $token;
                break;
            case 'q44':
                $token ="pv";
                $tokens = $token;
                break;
            case 'q45':
                $token ="maior";
                $tokens = $token;
                break;
            case 'q47':
                $token ="menor";
                $tokens = $token;
                break;
            case 'q52':
                $token ="ap";
                $tokens = $token;
                break;
            case 'q53':
                $token ="fp";
                $tokens = $token;
                break;
            case 'q56':
                $token ="ac";
                $tokens = $token;
                break;
            case 'q57':
                $token ="fc";
                $tokens = $token;
                break;
            case 'q65':
                $token ="programa";
                $tokens = $token;
                break;
            case 'q66':
                $token ="v";
                $tokens = $token;
                break;
            case 'q70':
                $token ="char";
                $tokens = $token;
                break;
            case 'q72':
                $token ="int";
                $tokens = $token;
                break;
            default:
                echo "<br>O estado não é final.";
        }        
        echo "<br>Token: '".$token. "',   Palavra: '".$palavra_atual."',   Estado: '$estado'".",   Posição inicial: '".$pos1."',   Posição final:'".$pos2."'<br>";

        $pos1 = 0;
        $pos2 = 0; 
        $estado = 'q0';
    }else{
        echo "Cadeia rejeitada"."<br>Estado atual: ".$estado;
        break;
    }   
}
echo '<br><a href="index.html">digitar novamente</a>';

    echo "<br>";

    $slr = new SLR();

    $tokens = '$';
    
    $entrada = array('programa', 'id', 'ap', 'int', 'id', 'fp', 'ac', 'printa', 'ap', 'id', 'fp', 'pv', 'fc', '$');
    if ($slr->parser($entrada))
        echo "\nLinguagem aceita";
    else
        echo "\nErro ao processar entrada";


?>