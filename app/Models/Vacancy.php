<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{

    public function getLinksJob()
    {
        $urls=Vacancy::select('indexJobAion','httpAinua')->get();
        return $urls;
    }


    public function getJobVacancy($id, $param)
    {
       // $users=\DB::table('vacancies')->where('indexJobAion',$id)->first();
        $users=Vacancy::where('indexJobAion',$id);
        //$as = new Vacancy();
        //$users=$as->where('indexJobAion',$request->id)->get();
        // $users=Vacancy::where('indexJobAion',$request->id)->get()->first();
        // $users=Vacancy::latest('indexJobAion')
        //->where('indexJobAion', '=', $request->id)
        //->get();


        if ($users==null) {
            echo 'not found';
            return $users = null;
        }
        $users=$users->get()->toArray()[0];
        if ($param=='del') {
            Vacancy::where('indexJobAion',$id)->delete();
            echo'this column is drop';
            return $users=null;
        }

        return $users;
    }

    public static function updateJobinBase($data, $index )
    {

        $i=0;
        foreach ($data as $key=>$value) {
            if (Vacancy::where('indexJobAion', $index[$i])->first()==NULL)
            {
                Vacancy::insertGetId(
                    ['indexJobAion' => $index[$i], 'httpAinua' => $key]
                );}
            foreach ($value as $key1=>$value1) {

                Vacancy::where('indexJobAion', $index[$i])
                    ->update([$key1 => $value1]);
            }$i++;}
        return compact('data','index');
    }


}
