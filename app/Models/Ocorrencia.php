<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    use HasFactory;

    // Define a tabela caso o nome não esteja no padrão no plural em inglês
    protected $table = 'ocorrencias';

    // Permite o preenchimento em massa desses campos
    protected $fillable = [
        'aluno_id',
        'user_id',
        'titulo',
        'gravidade',
        'data_ocorrencia',
        'descricao',
    ];

    /**
     * Relacionamento: Uma ocorrência pertence a um Aluno
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    /**
     * Relacionamento: Uma ocorrência é registrada por um Usuário/Servidor
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}