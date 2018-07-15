<?php
class Yekym extends Common {
    protected static $table_name = "yekym";
    protected static $db_fields = array(
        'id', 'col_letter', 'R', 'Q', 'P', 'O', 
        'N', 'M', 'L', 'K', 'J', 'I', 'H', 'G', 
        'F', 'E', 'D', 'C', 'B', 'A', 'Z', 'Y', 
        'X', 'W', 'V', 'U', 'T', 'S', 'at', 'bang', 
        'num', 'dollar', 'percent', 'karat', 'amper', 
        'astirisk', 'oparenth', 'cparenth', 'obracket', 
        'cbracket', 'comma', 'period', 'semicolon', 'colon', 
        'lessthan', 'greaterthan', 'question', 'slash', 
        'backslash', 'dash', 'equal', 'zero', 'one', 'two',
        'three', 'four', 'five', 'six', 'seven', 'eight', 
        'nine'
    );
    
    public $id; public $col_letter; public $R; public $Q;
    public $P; public $O; public $N; public $M; public $L;
    public $K; public $J; public $I; public $H; public $G;
    public $F; public $E; public $D; public $C; public $B;
    public $A; public $Z; public $Y; public $X; public $W;
    public $V; public $U; public $T; public $S; public $at;
    public $bang; public $num; public $dollar; public $percent;
    public $karat; public $amper; public $astirisk; 
    public $oparenth; public $cparenth; public $obracket; 
    public $cbracket; public $comma; public $period; 
    public $semicolon; public $colon; public $lessthan; 
    public $greaterthan; public $question; public $slash; // /
    public $backslash; // \
    public $dash; public $equal; public $zero; public $one; 
    public $two; public $three; public $four; public $five; 
    public $six; public $seven; public $eight; public $nine;
    
    public static function convert_character_to_word($char) {
        $string = "";
        switch ($char) {
            case "!":
                $string = "bang";
                break;
            case "@":
                $string = "at";
                break;
            case "#":
                $string = "num";
                break;
            case "$":
                $string = "dollar";
                break;
            case "%":
                $string = "percent";
                break;
            case "^":
                $string = "karat";
                break;
            case "&":
                $string = "amper";
                break;
            case "*":
                $string = "asterisk";
                break;
            case "(":
                $string = "oparenth";
                break;
            case ")":
                $string = "cparenth";
                break;
            case "[":
                $string = "obracket";
                break;
            case "]":
                $string = "cbracket";
                break;
            case ",":
                $string = "comma";
                break;
            case ".":
                $string = "period";
                break;
            case ";":
                $string = "semicolon";
                break;
            case ":":
                $string = "colon";
                break;
            case "<":
                $string = "lessthan";
                break;
            case ">":
                $string = "greaterthan";
                break;
            case "?":
                $string = "question";
                break;
            case "/":
                $string = "slash";
                break;
            case "\\":
                $string = "backslash";
                break;
            case "-":
                $string = "dash";
                break;
            case "=":
                $string = "equal";
                break;
            case "0":
                $string = "zero";
                break;
            case "1":
                $string = "one";
                break;
            case "2":
                $string = "two";
                break;
            case "3":
                $string = "three";
                break;
            case "4":
                $string = "four";
                break;
            case "5":
                $string = "five";
                break;
            case "6":
                $string = "six";
                break;
            case "7":
                $string = "seven";
                break;
            case "8":
                $string = "eight";
                break;
            case "9":
                $string = "nine";
                break;
                
            default :
                $string = $char;
                break;
        }
        return $string;
    }
    public static function generate_table_and_data() {
        $obj = new self;
        if ($obj->create_table()) {
            $obj->load_data();
            return "Table yekym created and populated";
        }
    }
    private function load_data() {
        global $base;
        $sql  = 'INSERT IGNORE INTO yekym (id, col_letter, R, Q, P, O, N, M, L, K, J, I, H, G, F, E, D, C, B, A, Z, Y, X, W, V, U, T, S, at, bang, num, dollar, percent, karat, amper, astirisk, oparenth, cparenth, obracket, cbracket, comma, period, semicolon, colon, lessthan, greaterthan, question, slash, backslash, dash, equal, zero, one, two, three, four, five, six, seven, eight, nine) VALUES ';
        $sql .= '(25, 0x41, 0x47, 0x4a, 0x44, 0x4d, 0x41, 0x50, 0x58, 0x53, 0x55, 0x56, 0x52, 0x59, 0x4f, 0x42, 0x4c, 0x45, 0x49, 0x48, 0x46, 0x4b, 0x43, 0x4e, 0x5a, 0x51, 0x57, 0x54, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(26, 0x42, 0x51, 0x54, 0x57, 0x5a, 0x43, 0x46, 0x49, 0x4c, 0x4f, 0x52, 0x55, 0x58, 0x41, 0x44, 0x47, 0x4a, 0x4d, 0x50, 0x53, 0x56, 0x59, 0x42, 0x45, 0x48, 0x4b, 0x4e, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(27, 0x43, 0x5a, 0x57, 0x54, 0x51, 0x4e, 0x4b, 0x48, 0x46, 0x42, 0x59, 0x56, 0x53, 0x50, 0x4d, 0x4a, 0x47, 0x44, 0x41, 0x58, 0x55, 0x52, 0x4f, 0x4c, 0x49, 0x46, 0x43, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(28, 0x44, 0x57, 0x48, 0x53, 0x44, 0x4f, 0x5a, 0x4b, 0x56, 0x47, 0x52, 0x43, 0x4e, 0x59, 0x4a, 0x55, 0x46, 0x51, 0x42, 0x4d, 0x58, 0x49, 0x54, 0x45, 0x50, 0x41, 0x4c, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(29, 0x45, 0x57, 0x44, 0x4b, 0x52, 0x59, 0x46, 0x4d, 0x54, 0x41, 0x48, 0x4f, 0x56, 0x43, 0x4a, 0x51, 0x58, 0x45, 0x4c, 0x53, 0x5a, 0x47, 0x4e, 0x55, 0x42, 0x49, 0x50, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(30, 0x46, 0x50, 0x45, 0x54, 0x49, 0x58, 0x4d, 0x42, 0x51, 0x46, 0x55, 0x4a, 0x59, 0x4e, 0x43, 0x52, 0x47, 0x56, 0x4b, 0x5a, 0x4f, 0x44, 0x53, 0x48, 0x57, 0x4c, 0x41, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(31, 0x47, 0x4a, 0x43, 0x56, 0x4f, 0x48, 0x41, 0x54, 0x4d, 0x46, 0x59, 0x52, 0x4b, 0x44, 0x57, 0x50, 0x49, 0x42, 0x55, 0x4e, 0x47, 0x5a, 0x53, 0x4c, 0x45, 0x58, 0x51, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(32, 0x48, 0x56, 0x45, 0x4e, 0x57, 0x46, 0x4f, 0x58, 0x47, 0x50, 0x59, 0x48, 0x51, 0x5a, 0x49, 0x52, 0x41, 0x4a, 0x53, 0x42, 0x4b, 0x54, 0x43, 0x4c, 0x55, 0x44, 0x4d, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(33, 0x49, 0x50, 0x55, 0x5a, 0x45, 0x4a, 0x4f, 0x54, 0x59, 0x44, 0x49, 0x4e, 0x53, 0x58, 0x43, 0x48, 0x4d, 0x52, 0x57, 0x42, 0x47, 0x4c, 0x51, 0x56, 0x41, 0x46, 0x4b, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(34, 0x4a, 0x4b, 0x42, 0x53, 0x4a, 0x41, 0x52, 0x49, 0x5a, 0x51, 0x48, 0x59, 0x50, 0x47, 0x58, 0x4f, 0x46, 0x57, 0x4e, 0x45, 0x56, 0x4d, 0x44, 0x55, 0x4c, 0x43, 0x54, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(35, 0x4b, 0x50, 0x51, 0x52, 0x53, 0x54, 0x55, 0x56, 0x57, 0x58, 0x59, 0x5a, 0x41, 0x42, 0x43, 0x44, 0x45, 0x46, 0x47, 0x48, 0x49, 0x4a, 0x4b, 0x4c, 0x4d, 0x4e, 0x4f, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(36, 0x4c, 0x4d, 0x42, 0x51, 0x46, 0x55, 0x4a, 0x59, 0x4e, 0x43, 0x52, 0x47, 0x56, 0x4b, 0x5a, 0x4f, 0x44, 0x53, 0x48, 0x57, 0x4c, 0x41, 0x50, 0x45, 0x54, 0x49, 0x58, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(37, 0x4d, 0x41, 0x54, 0x4d, 0x46, 0x59, 0x52, 0x4b, 0x44, 0x57, 0x50, 0x49, 0x42, 0x55, 0x4e, 0x47, 0x5a, 0x53, 0x4c, 0x45, 0x58, 0x51, 0x4a, 0x43, 0x56, 0x4f, 0x48, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(38, 0x4e, 0x4d, 0x56, 0x45, 0x4e, 0x57, 0x46, 0x4f, 0x58, 0x47, 0x50, 0x59, 0x48, 0x51, 0x5a, 0x49, 0x52, 0x41, 0x4a, 0x53, 0x42, 0x4b, 0x54, 0x43, 0x4c, 0x55, 0x44, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(39, 0x4f, 0x4e, 0x4b, 0x48, 0x45, 0x42, 0x59, 0x56, 0x53, 0x50, 0x4d, 0x4a, 0x47, 0x44, 0x41, 0x58, 0x55, 0x52, 0x4f, 0x4c, 0x49, 0x46, 0x43, 0x5a, 0x57, 0x54, 0x51, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(40, 0x50, 0x51, 0x4c, 0x47, 0x42, 0x57, 0x52, 0x4d, 0x48, 0x43, 0x58, 0x53, 0x4e, 0x49, 0x44, 0x59, 0x54, 0x4f, 0x4a, 0x45, 0x5a, 0x55, 0x50, 0x4b, 0x46, 0x41, 0x56, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(41, 0x51, 0x53, 0x5a, 0x47, 0x4e, 0x55, 0x42, 0x49, 0x50, 0x57, 0x44, 0x4b, 0x52, 0x59, 0x46, 0x4d, 0x54, 0x41, 0x48, 0x4f, 0x56, 0x43, 0x4a, 0x51, 0x58, 0x45, 0x4c, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(42, 0x52, 0x53, 0x52, 0x51, 0x50, 0x4f, 0x4e, 0x4d, 0x4c, 0x4b, 0x4a, 0x49, 0x48, 0x47, 0x46, 0x45, 0x44, 0x43, 0x42, 0x41, 0x5a, 0x59, 0x58, 0x57, 0x56, 0x55, 0x54, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(17, 0x53, 0x54, 0x41, 0x58, 0x52, 0x42, 0x48, 0x4d, 0x59, 0x4f, 0x46, 0x5a, 0x50, 0x57, 0x4a, 0x43, 0x44, 0x51, 0x47, 0x56, 0x49, 0x45, 0x55, 0x4e, 0x53, 0x4c, 0x4b, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(18, 0x54, 0x4b, 0x4c, 0x53, 0x46, 0x55, 0x45, 0x49, 0x56, 0x47, 0x51, 0x44, 0x43, 0x4a, 0x57, 0x50, 0x5a, 0x4e, 0x4f, 0x59, 0x4d, 0x48, 0x42, 0x52, 0x58, 0x41, 0x54, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(19, 0x55, 0x5a, 0x58, 0x56, 0x54, 0x52, 0x50, 0x4e, 0x4c, 0x4a, 0x48, 0x46, 0x44, 0x42, 0x59, 0x57, 0x55, 0x53, 0x51, 0x4f, 0x4d, 0x4b, 0x49, 0x47, 0x45, 0x43, 0x41, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(20, 0x56, 0x4d, 0x4f, 0x4b, 0x51, 0x49, 0x53, 0x47, 0x55, 0x45, 0x57, 0x43, 0x59, 0x41, 0x4e, 0x4c, 0x50, 0x4a, 0x52, 0x48, 0x54, 0x46, 0x56, 0x44, 0x58, 0x42, 0x5a, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(21, 0x57, 0x56, 0x51, 0x4c, 0x47, 0x42, 0x57, 0x52, 0x4d, 0x48, 0x43, 0x58, 0x53, 0x4e, 0x49, 0x44, 0x59, 0x54, 0x4f, 0x4a, 0x45, 0x5a, 0x55, 0x50, 0x4b, 0x46, 0x41, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(22, 0x58, 0x45, 0x4a, 0x4f, 0x54, 0x59, 0x44, 0x49, 0x4e, 0x53, 0x58, 0x43, 0x48, 0x4d, 0x52, 0x57, 0x42, 0x47, 0x4c, 0x51, 0x56, 0x41, 0x46, 0x4b, 0x50, 0x55, 0x5a, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(23, 0x59, 0x4e, 0x53, 0x49, 0x58, 0x44, 0x43, 0x59, 0x48, 0x54, 0x4d, 0x4f, 0x52, 0x4a, 0x57, 0x45, 0x42, 0x5a, 0x47, 0x55, 0x4c, 0x50, 0x51, 0x4b, 0x56, 0x46, 0x41, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), ';
        $sql .= '(24, 0x5a, 0x41, 0x43, 0x45, 0x47, 0x49, 0x4b, 0x4d, 0x4f, 0x51, 0x53, 0x55, 0x57, 0x59, 0x42, 0x44, 0x46, 0x48, 0x4a, 0x4c, 0x4e, 0x50, 0x52, 0x54, 0x56, 0x58, 0x5a, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", NULL, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")';
        $base->query($sql);
        
    }
    
    private function create_table() {
        global $base;
        $sql  = 'CREATE TABLE IF NOT EXISTS yekym ( ';
        $sql .= 'id int(11) NOT NULL AUTO_INCREMENT, ';
        $sql .= 'col_letter varbinary(1) NOT NULL, ';
        $sql .= 'R varbinary(1) NOT NULL, ';
        $sql .= 'Q varbinary(1) NOT NULL, ';
        $sql .= 'P varbinary(1) NOT NULL, ';
        $sql .= 'O varbinary(1) NOT NULL, ';
        $sql .= 'N varbinary(1) NOT NULL, ';
        $sql .= 'M varbinary(1) NOT NULL, ';
        $sql .= 'L varbinary(1) NOT NULL, ';
        $sql .= 'K varbinary(1) NOT NULL, ';
        $sql .= 'J varbinary(1) NOT NULL, ';
        $sql .= 'I varbinary(1) NOT NULL, ';
        $sql .= 'H varbinary(1) NOT NULL, ';
        $sql .= 'G varbinary(1) NOT NULL, ';
        $sql .= 'F varbinary(1) NOT NULL, ';
        $sql .= 'E varbinary(1) NOT NULL, ';
        $sql .= 'D varbinary(1) NOT NULL, ';
        $sql .= 'C varbinary(1) NOT NULL, ';
        $sql .= 'B varbinary(1) NOT NULL, ';
        $sql .= 'A varbinary(1) NOT NULL, ';
        $sql .= 'Z varbinary(1) NOT NULL, ';
        $sql .= 'Y varbinary(1) NOT NULL, ';
        $sql .= 'X varbinary(1) NOT NULL, ';
        $sql .= 'W varbinary(1) NOT NULL, ';
        $sql .= 'V varbinary(1) NOT NULL, ';
        $sql .= 'U varbinary(1) NOT NULL, ';
        $sql .= 'T varbinary(1) NOT NULL, ';
        $sql .= 'S varbinary(1) NOT NULL, ';
        $sql .= 'at varbinary(1) NOT NULL, ';
        $sql .= 'bang varbinary(1) NOT NULL, ';
        $sql .= 'num varbinary(1) NOT NULL, ';
        $sql .= 'dollar varbinary(1) NOT NULL, ';
        $sql .= 'percent varbinary(1) NOT NULL, ';
        $sql .= 'karat varbinary(1) NOT NULL, ';
        $sql .= 'amper varbinary(1) NOT NULL, ';
        $sql .= 'astirisk varbinary(1) NOT NULL, ';
        $sql .= 'oparenth varbinary(1) NOT NULL, ';
        $sql .= 'cparenth varbinary(1) NOT NULL, ';
        $sql .= 'obracket varbinary(1) NOT NULL, ';
        $sql .= 'cbracket varbinary(1) NOT NULL, ';
        $sql .= 'comma varbinary(1) NOT NULL, ';
        $sql .= 'period varbinary(1) NOT NULL, ';
        $sql .= 'semicolon varbinary(1) NOT NULL, ';
        $sql .= 'colon varbinary(1) DEFAULT NULL, ';
        $sql .= 'lessthan varbinary(1) NOT NULL, ';
        $sql .= 'greaterthan varbinary(1) NOT NULL, ';
        $sql .= 'question varbinary(1) NOT NULL, ';
        $sql .= 'slash varbinary(1) NOT NULL, ';
        $sql .= 'backslash varbinary(1) NOT NULL, ';
        $sql .= 'dash varbinary(1) NOT NULL, ';
        $sql .= 'equal varbinary(1) NOT NULL, ';
        $sql .= 'zero varbinary(1) NOT NULL, ';
        $sql .= 'one varbinary(1) NOT NULL, ';
        $sql .= 'two varbinary(1) NOT NULL, ';
        $sql .= 'three varbinary(1) NOT NULL, ';
        $sql .= 'four varbinary(1) NOT NULL, ';
        $sql .= 'five varbinary(1) NOT NULL, ';
        $sql .= 'six varbinary(1) NOT NULL, ';
        $sql .= 'seven varbinary(1) NOT NULL, ';
        $sql .= 'eight varbinary(1) NOT NULL, ';
        $sql .= 'nine varbinary(1) NOT NULL, ';
        $sql .= 'PRIMARY KEY (col_letter), ';
        $sql .= 'UNIQUE KEY id (id) ';
        $sql .= ') ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8';
            return $base->query($sql);
    }
}


//!      # 	     $ 	     & 	     ' 	     ( 	     ) 	     * 	     + 	     , 	     / 	     : 	     ; 	     = 	     ? 	     @ 	     [ 	     ]
//%21 	%23 	%24 	%26 	%27 	%28 	%29 	%2A 	%2B 	%2C 	%2F 	%3A 	%3B 	%3D 	%3F 	%40 	%5B 	%5D


?>
