<?php

namespace Horus\SiteBundle\AST\Functions;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Lexer;

class Age extends FunctionNode
{
    
    /**
     * @var \Doctrine\ORM\Query\AST\ComparisonExpression
     */
    private $dob;
    
    
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->dob = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    /**
     * Get SQL 
     * 
     * @param SqlWalker $sqlWalker
     * @return string
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf('(YEAR(CURRENT_DATE)-YEAR(%s)) - (RIGHT(CURRENT_DATE,5)<RIGHT(%s,5))',
                $this->dob->dispatch($sqlWalker),
                $this->dob->dispatch($sqlWalker));
    }
}
?>
