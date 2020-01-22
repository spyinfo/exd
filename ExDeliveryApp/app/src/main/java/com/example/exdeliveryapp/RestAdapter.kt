package com.example.exdeliveryapp

import android.content.Context
import android.os.Parcel
import android.os.Parcelable
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.core.view.get
import androidx.recyclerview.widget.RecyclerView
import androidx.recyclerview.widget.RecyclerView.Adapter

class RestAdapter(var c: Context, var models:ArrayList<RestarauntModel>) : Adapter<RestHolder>() {


    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RestHolder {
        var view: View = LayoutInflater.from(parent.context).inflate(R.layout.row_rest, null)

        return RestHolder(view)
    }

    override fun onBindViewHolder(holder: RestHolder, position: Int) {
        holder.mTitle.setText(models.get(position).Title)
        holder.mDes.setText(models.get(position).Description)
        holder.mImageView.setImageResource(models.get(position).Cover)
        holder.mBtn.setOnClickListener { view ->
            Toast.makeText(view.context, "Не кликай, не работает", Toast.LENGTH_LONG).show()


        }
    }

    override fun getItemCount(): Int {
        return models.size
    }



}