<?php

namespace App\Http\Controllers;

class SpecializedOne extends Controller {
  protected function getR():bool {
    $A = $this->a;
    $B = $this->b;
    $C = $this->c;

    $res = $A && $B && $C;
    if ($res) {
        $D = $this->d;
        $E = $this->e;
        $this->y = 2 * $D + ( $D * $E / 100 );
    }
    return $res;
  }
}
