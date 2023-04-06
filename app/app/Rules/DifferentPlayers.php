<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DifferentPlayers implements Rule
{
    private $player1Id;
    private $player2Id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($player1Id, $player2Id)
    {
        $this->player1Id = $player1Id;
        $this->player2Id = $player2Id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->player1Id !== $this->player2Id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Player 1 and Player 2 cannot be the same.';
    }
}
