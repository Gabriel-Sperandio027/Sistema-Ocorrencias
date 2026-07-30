<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'turma_id',
        'nome',
        'email',
        'email_responsavel',
        'telefone_responsavel',
        'data_nascimento',
        'matricula',
    ];

    /**
     * Relacionamento: O aluno pertence a uma turma.
     */
    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    /**
     * Relacionamento: O aluno possui muitas ocorrências.
     */
    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencia::class);
    }
}