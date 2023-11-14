<?php

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
                        11=>'PRINTA',
                        12=>'FOR']);

class SLR{
    private $afd;

    public function __construct(){
        
        //  $entrada = 'q2', programa nomeprog ( int a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }

        $this->afd = array(
            0=>['ACTION'=>['programa'=>'S 2'],    // S 2 nomeprog ( int a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
                  'GOTO'=>[6=>['$'=>1]]], 
            1=>['ACTION'=>['$'=>'ACC '],'GOTO'=>[]],
            2=>['ACTION'=>['id'=>'S 3'],'GOTO'=>[]],  // S 3 ( int a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            3=>['ACTION'=>['ap'=>'S 4'],'GOTO'=>[]],  // S 4  int a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            4=>['ACTION'=>['int'=>'S 5','char'=>'S 6', 'num'=>'S 7','fp'=>'R 0 2'],  // S 5 a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
                  'GOTO'=>[0=>['id'=>8],1=>['v'=>10,'fp'=>10,'pv'=>10],2=>['v'=>13,'fp'=>15]]],
            5=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]], // S 5 a ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            6=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]],
            7=>['ACTION'=>['id'=>'R 1 0'],'GOTO'=>[]],
            8=>['ACTION'=>['id'=>'S 9'],'GOTO'=>[]], // S 9 ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            9=>['ACTION'=>['pv'=>'R 2 1','fp'=>'R 2 1','v'=>'R 2 1'],'GOTO'=>[]], // S 9 ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            10=>['ACTION'=>['fp'=>'R 1 2','v'=>'R 1 2'],'GOTO'=>[]], // S 9 ) { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            11=>['ACTION'=>['fp'=>'R 3 2','v'=>'R 3 2'],'GOTO'=>[]],
            12=>['ACTION'=>['pv'=>'S 37'],'GOTO'=>[]],
            13=>['ACTION'=>['v'=>'S 14'],'GOTO'=>[]],
            14=>['ACTION'=>['int'=>'S 5','char'=>'S 6','num'=>'S 7'],
                   'GOTO'=>[0=>['id'=>8],2=>['v'=>11,'pv'=>11]]],
            15=>['ACTION'=>['fp'=>'S 16'],'GOTO'=>[4=>['ac'=> 16]]],  // S 16 { for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            16=>['ACTION'=>['ac'=>'S 17'],'GOTO'=>[]],  // S 17 for ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            17=>['ACTION'=>['id'=>'S 18','int'=>'S 5','char'=>'S 6','num'=>'S 7','ap'=>'S 21', 'printa' => 'S 41', 'ifi' => 'S 45', 'for' => 'S 55'], // S 55 ( int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
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
            47=>['ACTION'=>['maior'=>'S 48','menor'=>'S 48','igualdade'=>'S 48'],'GOTO'=>[]], 
            48=>['ACTION'=>['id'=>'S 49', 'const' => 'S 49'],'GOTO'=>[]],
            49=>['ACTION'=>['fp'=>'S 50'],'GOTO'=>[]],
            50=>['ACTION'=>['ac'=>'R 8 4'],'GOTO'=>[]],
            52=>['ACTION'=>['ap'=>'R 8 4'],'GOTO'=>[]],
            53=>['ACTION'=>['fc'=>'R 8 4'],'GOTO'=>[]],
            54=>['ACTION'=>['$'=>'R 9 6'],'GOTO'=>[]],                                                                                                                            
            55=>['ACTION'=>['ap'=>'S 56'],'GOTO'=>[]], // S 56 int i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            56=>['ACTION'=>['int'=>'S 57','id'=>'S 58'],'GOTO'=>[]], // S 57 i = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            57=>['ACTION'=>['id'=>'S 58'],'GOTO'=>[]], // S 58 = 0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            58=>['ACTION'=>['igual'=>'S 59'],'GOTO'=>[]], // S 59  0 ; i < 10 ; i ++ ) { print ( a ) ; } }
            59=>['ACTION'=>['const'=>'S 60','id'=>'S 60'],'GOTO'=>[]], // S 60 ; i < 10 ; i ++ ) { print ( a ) ; } }
            60=>['ACTION'=>['pv'=>'S 61'],'GOTO'=>[]], // S 61 i < 10 ; i ++ ) { print ( a ) ; } }
            61=>['ACTION'=>['id'=>'S 62'],'GOTO'=>[]], // S 62 < 10 ; i ++ ) { print ( a ) ; } }
            62=>['ACTION'=>['menor' => 'S 63','maior' => 'S 63','menorigual' => 'S 63','maiorigual' => 'S 63'],'GOTO'=>[]], // S 63 10 ; i ++ ) { print ( a ) ; } }
            63=>['ACTION'=>['id' => 'S 64','const' => 'S 64'],'GOTO'=>[]], // S 64 ; i ++ ) { print ( a ) ; } }
            64=>['ACTION'=>['pv' => 'S 65'],'GOTO'=>[]], // S 65 i ++ ) { print ( a ) ; } }
            65=>['ACTION'=>['id' => 'S 66'],'GOTO'=>[]], // S 66 ++ ) { print ( a ) ; } }
            66=>['ACTION'=>['incremento' => 'S 67','decremento' => 'S 67'],'GOTO'=>[]],
            67=>['ACTION'=>['fp' => 'S 68'],'GOTO'=>[]],
            68=>['ACTION'=>['ac' => 'R 16 4'],'GOTO'=>[]]

        );
        
  
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
                
            echo '<br>';
            $acao = explode(' ',$move);
            echo " | Ação:".$move;
            switch($acao[0]){
                case 'S': // Shift - Empilha e avança o ponteiro
                    array_push($pilha,$acao[1]);
                    $i++;
                    break;
                case 'R': // Reduce - Desempilha e usa o GOTO para desviar
                    for ($j = 0; $j<$acao[1]; $j++)
                        array_pop($pilha);
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

?>