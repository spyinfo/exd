package com.example.exdeliveryapp.ui.rests

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.exdeliveryapp.R
import com.example.exdeliveryapp.RestAdapter
import com.example.exdeliveryapp.RestarauntModel
import kotlinx.android.synthetic.main.fragment_rests.*
import kotlinx.android.synthetic.main.fragment_rests.view.*

class RestFragment : Fragment() {

    private lateinit var homeViewModel: RestViewModel

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        homeViewModel =
            ViewModelProviders.of(this).get(RestViewModel::class.java)
        val root = inflater.inflate(R.layout.fragment_rests, container, false)


            if(root.recyclerView != null) {

                var mrv: RecyclerView = root.recyclerView
                mrv.layoutManager = LinearLayoutManager(root.context)

                var adapter: RestAdapter = RestAdapter(root.context!!, getRestList())
                mrv.adapter = adapter

            }
            else{

            }


        return root
    }

    fun getRestList(): ArrayList<RestarauntModel>{

        var models:ArrayList<RestarauntModel> = arrayListOf()

        var m: RestarauntModel = RestarauntModel()
        m.Title = "Ресторан Фаренгейт"
        m.Description = "Европейская, Центральноевропейская \$\$ - \$\$\$"
        m.Cover = R.drawable.rest1
        models.add(m)

        var m1: RestarauntModel = RestarauntModel()
        m1.Title = "Джумбус"
        m1.Description = "Средиземноморская, Барбекю \$\$ - \$\$\$"
        m1.Cover = R.drawable.rest2
        models.add(m1)

        m1 = RestarauntModel()
        m1.Title = "Сабор де ла Вида Ресторан"
        m1.Description = "Средиземноморская, Винный бар \$\$ - \$\$\$"
        m1.Cover = R.drawable.rest3
        models.add(m1)

        m1 = RestarauntModel()

        m1.Title = "Lure Oyster Bar"
        m1.Description = "Средиземноморская, Европейская $$\$\$ - $$\$\$$"
        m1.Cover = R.drawable.rest4
        models.add(m1)

        m1 = RestarauntModel()

        m1.Title = "Стейк Хаус Бутчер"
        m1.Description = "Американская, Стейк-хаус  \$ - \$\$"
        m1.Cover = R.drawable.rest5
        models.add(m1)

        m1 = RestarauntModel()

        m1.Title = "Одесса-мама"
        m1.Description = "Европейская, Русская  \$\$ - \$\$\$"
        m1.Cover = R.drawable.rest6
        models.add(m1)

        m1 = RestarauntModel()

        m1.Title = "Практика"
        m1.Description = "Итальянская, Американская  \$ - \$\$"
        m1.Cover = R.drawable.rest7
        models.add(m1)


        return models
    }
}