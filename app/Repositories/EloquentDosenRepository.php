<?php

namespace App\Repositories;

use App\Models\Dosen;
use App\Models\Kalab;
use App\Models\Kaprodi;
use App\Repositories\Contracts\DosenRepository;

class EloquentDosenRepository implements DosenRepository
{
    public function store($data)
    {
        return Dosen::create($data);
    }

    public function getByJurusan($jurusan_id)
    {
        return Dosen::where('jurusan_id', $jurusan_id)->get();
    }

    public function getByRmk($rmk_id)
    {
        return Dosen::where('rmk_id', $rmk_id)->get();
    }

    public function getByFakultas($fakultas_id)
    {
        return Dosen::where('fakultas_id', $fakultas_id)->get();
    }

    public function getByProgramStudiAndJurusan($jurusan_id, $program_studi_id)
    {
        return Dosen::where('jurusan_id', $jurusan_id)->where('program_studi_id', $program_studi_id)->get();
    }

    public function getById($id)
    {
        return Dosen::where('id', $id)->first();
    }

    public function deleteDosen($id)
    {
        return Dosen::where('id', $id)->delete();
    }

    public function getByIdNotNull($id)
    {
        return Dosen::where('id', $id)->where('jurusan_id', '<>', null)->where('fakultas_id', '<>', null)->where('rmk_id', '<>', null)->first();
    }

    public function storeKaprodi($data)
    {
        return Kaprodi::create($data);
    }

    public function getKaprodiByJurusan($jurusan_id)
    {
        return Kaprodi::where('jurusan_id', $jurusan_id)->first();
    }

    public function getKaprodiByDosenId($id)
    {
        return Kaprodi::whereIn('dosen_id', $id)->get();
    }

    public function deleteKaprodi($id)
    {
        return Kaprodi::where('dosen_id', $id)->delete();
    }

    public function getKaprodisByAll($jurusan_id, $program_studi_id)
    {
        return Kaprodi::where('jurusan_id', $jurusan_id)->where('program_studi_id', $program_studi_id)->first();
    }

    public function storeKalab($data)
    {
        return Kalab::create($data);
    }

    public function getKalabsByRmk($rmk_id)
    {
        return Kalab::where('rmk_id', $rmk_id)->first();
    }

    public function getKalabsByDosenId($id)
    {
        return Kalab::whereIn('dosen_id', $id)->get();
    }

    public function deleteKalab($id)
    {
        return Kalab::where('dosen_id', $id)->delete();
    }
}
