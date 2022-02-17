<?php

    require_once 'vendor/autoload.php';

    //referenciando o namespace da dompdf
    use Dompdf\Dompdf;

    $pdo = new PDO('mysql:host=localhost; dbname=desafio-php', 'root', '');

    $sql = $pdo->query('SELECT * FROM product');

    $html = '<table border="1" width="100%">';
        $html .= '<thead>';
            $html .= '<tr>';
                $html .= '<th>ID</th>';
                $html .= '<th>Produto</th>';    
            $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
            //loop para listagem
            while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) 
            {        
                $html .= '<tr>';   
                    $html .= '<td>'. $linha['id'] .'</td>';
                    $html .= '<td>'. $linha['name'] .'</td>';
                $html .= '</tr>';  
            }
        $html .= '</tbody>';
    $html .= '</table>';

    //echo $html;

    $dompdf = new Dompdf;

    //converter html
    $dompdf->loadHtml($html);

    //definir tamanho e orientação (paisagem ou retrato)
    $dompdf->setPaper('A4', 'portrait');

    //renderizar o html
    $dompdf->render();

    //enviar para o nosso browser
    $dompdf->stream('Relatorio_Produto.pdf', array('Attachment' => false));
?>
