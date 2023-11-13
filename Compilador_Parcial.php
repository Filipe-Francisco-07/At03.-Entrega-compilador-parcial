<?php

/*gramatica

PROGRAMA → programa id ap LISTA_VAR fp ab COMANDOS fc
LISTA_VAR  →LISTA_VAR v VARIAVEL | ε 
VARIAVEL  → TIPO id
TIPO  → int | char | num
COMANDOS  → COMANDOS BLOCO | BLOCO
BLOCO → ATIBUICAO pv | PAR pv
ATIBUICAO → id igual EXP
EXP →EXP mais EXP2 | EXP2
EXP2 → EXP2 menos EXP3 | EXP3
EXP3 → ap EXP fp | id
*/
/*
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
define('EXP2', 10);
define('EXP3', 11);
define('IFI', 12);

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
    EXP2 => '<EXP2>',
    EXP3 => '<EXP3>',
    IFI => '<IF>',

]);

*/

define('NAO_TERMINAIS',[0=>'TIPO',
                        1=>'VARIAVEL',
                        2=>'LISTA_VAR',
                        3=>'COMANDOS',
                        4=>'COMANDO',
                        5=>'ATRIBUICAO',
                        6=>'PROGRAMA',
                        7=>'EXP',
                        8=>'EXP2',
                        9=>'EXP3',
                        10=>'IFI',   
                        11=>'PRINTA']);

class SLR{
    private $afd;

    public function __construct(){
        
        //  $entrada = array('programa','id','ap','fp','ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');

        $this->afd = array(
            0=>['ACTION'=>['programa'=>'S 2'],    //S2 'id','ap','fp','ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
                  'GOTO'=>[6=>['$'=>1]]], 
            1=>['ACTION'=>['$'=>'ACC '],'GOTO'=>[]],
            2=>['ACTION'=>['id'=>'S 3'],'GOTO'=>[]], //S3 'ap','fp','ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
            3=>['ACTION'=>['ap'=>'S 4'],'GOTO'=>[]],  //S4 'fp','ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
            4=>['ACTION'=>['int'=>'S 5','char'=>'S 6', 'num'=>'S 7','fp'=>'R 0 2'],  //R0 'fp','ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
                  'GOTO'=>[0=>['id'=>8],1=>['v'=>10,'fp'=>10,'pv'=>10],2=>['v'=>13,'fp'=>15]]],
            5=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]],
            6=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]],
            7=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]],
            8=>['ACTION'=>['id'=>'S 9'],'GOTO'=>[]],
            9=>['ACTION'=>['pv'=>'R 2 1','fp'=>'R 2 1','v'=>'R 2 1'],'GOTO'=>[]],
            10=>['ACTION'=>['fp'=>'R 1 2','v'=>'R 1 2'],'GOTO'=>[]],
            11=>['ACTION'=>['fp'=>'R 3 2','v'=>'R 3 2'],'GOTO'=>[]],
            12=>['ACTION'=>['pv'=>'S 37'],'GOTO'=>[]],
            13=>['ACTION'=>['v'=>'S 14'],'GOTO'=>[]],
            14=>['ACTION'=>['int'=>'S 5','char'=>'S 6','num'=>'S 7'],
                   'GOTO'=>[0=>['id'=>8],2=>['v'=>11,'pv'=>11]]],
            15=>['ACTION'=>['fp'=>'S 16'],'GOTO'=>[]],  //S 16 'ac','if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
            16=>['ACTION'=>['ac'=>'S 17'],'GOTO'=>[]],  //S 17 'if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
            17=>['ACTION'=>['id'=>'S 18','int'=>'S 5','char'=>'S 6','num'=>'S 7','ap'=>'S 21', 'printa' => 'S 41', 'ifi' => 'S 45'], //S 17 'if','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');   R 8 4 'ap','id','fp','pv','fc','fc','$');
                   'GOTO'=>[0=>['id'=>8],1=>['v'=>12,'fp'=>12,'pv'=>12],4=>['ap'=> 41,'id'=>36,'fc'=>36,'int'=>36,'char'=>36,'num'=>36],5=>['pv'=>39],9=>['mais'=>24,'menos'=>24,'fp'=>24,'pv'=>24],3=>['fc'=>32,'int'=>34,'char'=>34,'num'=>34,'id'=>34],8=>['mais'=>28,'menos'=>29,'fp'=>28,'pv'=>28],7=>['mais'=>25,'fp'=>38,'pv'=>38]]],
            18=>['ACTION'=>['igual'=>'S 19'],'GOTO'=>[]],
            19=>['ACTION'=>['id'=>'S 20','ap'=>'S 21'],
                   'GOTO'=>[2=>['fp'=>31],5=>['pv'=>38],9=>['mais'=>24,'menos'=>24,'fp'=>24,'pv'=>24],8=>['mais'=>28,'menos'=>29,'fp'=>28,'pv'=>28],7=>['mais'=>25,'fp'=>38,'pv'=>38]]],
            20=>['ACTION'=>['fp'=>'R 1 9','pv'=>'R 1 9','mais'=>'R 1 9','menos'=>'R 1 9'],'GOTO'=>[]],
            21=>['ACTION'=>['id'=>'S 20','ap'=>'S 21'],
                   'GOTO'=>[2=>['fp'=>22],5=>['pv'=>24],9=>['mais'=>24,'menos'=>24,'fp'=>24,'pv'=>24],8=>['mais'=>28,'menos'=>29,'fp'=>28,'pv'=>28],7=>['mais'=>25,'fp'=>22,'pv'=>22]]],
            22=>['ACTION'=>['fp'=>'S 23'],'GOTO'=>[]],
            23=>['ACTION'=>['fp'=>'R 3 9','pv'=>'R 3 9','mais'=>'R 3 9','menos'=>'R 3 9'],'GOTO'=>[]],
            24=>['ACTION'=>['fp'=>'R 1 8','pv'=>'R 1 8','mais'=>'R 1 8','menos'=>'R 1 8'],'GOTO'=>[]],
            25=>['ACTION'=>['mais'=>'S 26'],'GOTO'=>[]],
            26=>['ACTION'=>['id'=>'S 20','ap'=>'S 21'],
                   'GOTO'=>[2=>['fp'=>27],8=>['menos'=>29,'fp'=>27,'pv'=>27],9=>['mais'=>24,'menos'=>24,'fp'=>24,'pv'=>24]]],
            27=>['ACTION'=>['fp'=>'R 3 7','pv'=>'R 3 7','mais'=>'R 3 7'],'GOTO'=>[]],
            28=>['ACTION'=>['fp'=>'R 1 7','pv'=>'R 1 7','mais'=>'R 1 7'],'GOTO'=>[]],
            29=>['ACTION'=>['menos'=>'S 30'],'GOTO'=>[]],
            30=>['ACTION'=>['id'=>'S 20','ap'=>'S 21'],
                   'GOTO'=>[9=>['mais'=>31,'menos'=>31,'fp'=>31,'pv'=>31]]],
            31=>['ACTION'=>['fp'=>'R 3 8','pv'=>'R 3 8','mais'=>'R 3 8','menos'=>'R 3 8'],'GOTO'=>[]],
            32=>['ACTION'=>['fc'=>'S 33'],'GOTO'=>[]],
            33=>['ACTION'=>['$'=>'R 8 6', 'fc'=>'S 54']],
            34=>['ACTION'=>['id'=>'S 18','int'=>'S 5','char'=>'S 6','num'=>'S 7'],
                   'GOTO'=>[0=>['id'=>8],1=>['v'=>12,'fp'=>12,'pv'=>12],3=>['fc'=>35],4=>['id'=>35,'fc'=>35,'int'=>35,'char'=>35,'num'=>35]]],
            35=>['ACTION'=>['id'=>'R 2 3','int'=>'R 2 3','char'=>'R 2 3','num'=>'R 2 3','fc'=>'R 2 3'],'GOTO'=>[]],
            36=>['ACTION'=>['id'=>'R 1 3','int'=>'R 1 3','char'=>'R 1 3','num'=>'R 1 3','fc'=>'R 1 3'],'GOTO'=>[]],  //S 44 ,'pv','fc','fc','$');
            37=>['ACTION'=>['id'=>'R 2 4','int'=>'R 2 4','char'=>'R 2 4','num'=>'R 2 4','fc'=>'R 2 4'],'GOTO'=>[]],
            38=>['ACTION'=>['pv'=>'R 3 5'],'GOTO'=>[]],
            39=>['ACTION'=>['pv'=>'S 40'],'GOTO'=>[]],  //S 40 ,'fc','fc','$');
            40=>['ACTION'=>['id'=>'R 2 4','int'=>'R 2 4','char'=>'R 2 4','num'=>'R 2 4','fc'=>'R 2 4'],'GOTO'=>[]] ,
            41=>['ACTION'=>['ap'=>'S 42'],'GOTO'=>[]], // S 42 'id','fp','pv','fc','fc','$');
            42=>['ACTION'=>['id'=>'S 43'],'GOTO'=>[]], // S 43 'fp','pv','fc','fc','$');
            43=>['ACTION'=>['fp'=>'S 44'],'GOTO'=>[]], // S 44 ,'pv','fc','fc','$');
            44=>['ACTION'=>['pv'=>'R 4 5'],'GOTO'=>[]],  //S 44 ,'pv','fc','fc','$');

            45=>['ACTION'=>['ap'=>'S 46'],'GOTO'=>[]], 
            46=>['ACTION'=>['id'=>'S 47', 'const' => 'S 47'],'GOTO'=>[]],  //S 47 'id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
            47=>['ACTION'=>['maior'=>'S 48','menor'=>'S 48','+'=>'S'],'GOTO'=>[]], 
            48=>['ACTION'=>['id'=>'S 49', 'const' => 'S 49'],'GOTO'=>[]],
            49=>['ACTION'=>['fp'=>'S 50'],'GOTO'=>[]],
            50=>['ACTION'=>['ac'=>'S 51'],'GOTO'=>[]],
            51=>['ACTION'=>['printa'=>'S 52'],'GOTO'=>[]],
            52=>['ACTION'=>['ap'=>'R 8 4'],'GOTO'=>[]],
            53=>['ACTION'=>['fc'=>'R 8 4'],'GOTO'=>[]],
            54=>['ACTION'=>['$'=>'R 9 6'],'GOTO'=>[]]);
    
          //R 8 4 'ap','id','fp','pv','fc','fc','$');
        }
    /***
     * Entrada deve ser a lista de tokens gerada pelo analisador léxico
     */
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
                case 'S': // Shift - Empilha e avança o ponteiro
                    array_push($pilha,$acao[1]);
                    $i++;
                    break;
                case 'R': // Reduce - Desempilha e Desvia (para indicar a redução)  
                    for ($j = 0; $j<$acao[1]; $j++)
                        array_pop($pilha);
                    echo ' | Reduzio para '.NAO_TERMINAIS[$acao[2]];                    
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

$delta = array('q0'=>array('a'=>'q3', 'b'=>'q3', 'c'=>'q67', 'd'=>'q3', 'e'=>'q3','f'=> 'q3', 'g'=>'q3', 'h'=>'q3','i'=>'q1', 'j'=>'q3', 'k'=>'q3', 'l'=>'q3', 'm'=>'q3', 'n'=>'q3', 'o'=>'q3', 'p'=>'q28', 'q'=>'q3', 'r'=>'q3', 's'=>'q3', 't'=>'q3', 'u'=>'q3', 'v'=>'q3', 'w'=>'q3', 'x'=>'q3', 'y'=>'q3', 'z'=>'q3',0 => 'q37', 1 => 'q37', 2 => 'q37', 3 => 'q37', 4 => 'q37', 5 => 'q37', 6 => 'q37', 7 => 'q37', 8 => 'q37', 9 => 'q37', '+' => 'q38', '-' => 'q40','*' => 'q42','/' => 'q43',';' => 'q44','>' => 'q45','<' => 'q47','=' => 'q49','^' => 'q51','(' => 'q52',')' => 'q53','[' => 'q54',']' => 'q55','{' => 'q56','}' => 'q57',',' => 'q66'),
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
$tokens = [];
$index = 0;

$finais = array('q2', 'q3','q32','q36','q37', 'q38', 'q39','q40','q41','q42', 'q43', 'q44','q45','q46','q47', 'q48', 'q49', 'q50','q51','q52','q53', 'q54', 'q55','q56','q57','q58','q65','q66','q70','q72');

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
                $tokens[$index] = $token;
                $index++;

                break;
            case 'q3':
                $token = "id";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q32':
                $token ="printa";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q37':
                $token ="const";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q38':
                $token ="mais";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q40':
                $token ="menos";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q43':
                $token ="barra";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q44':
                $token ="pv";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q45':
                $token ="maior";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q47':
                $token ="menor";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q52':
                $token ="ap";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q53':
                $token ="fp";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q56':
                $token ="ac";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q57':
                $token ="fc";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q65':
                $token ="programa";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q66':
                $token ="v";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q70':
                $token ="char";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q72':
                $token ="int";
                $tokens[$index] = $token;
                $index++;
                break;
            case 'q49':
                $token ="igual";
                $tokens[$index] = $token;
                $index++;
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

    $tokens[$index] = '$';

    foreach($tokens as $tok){
        echo($tok.'<br>');
    }
    // $entrada = array('programa','id','ap','fp','ac','ifi','ap','id','maior','id','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
    // $entrada = array('programa','id','ap','fp','ac','printa','ap','id','fp','pv','fc','fc','$');

    $entrada = array('programa','id','ap','fp','ac','printa','ap','id','fp','pv','fc','fc','$');
    if ($slr->parser($entrada))
        echo "\nLinguagem aceita";
    else
        echo "\nErro ao processar entrada";


?>