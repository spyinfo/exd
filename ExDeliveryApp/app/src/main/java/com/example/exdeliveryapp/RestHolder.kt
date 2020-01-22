package com.example.exdeliveryapp

import androidx.recyclerview.widget.RecyclerView
import org.jetbrains.annotations.NotNull
import android.view.View
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView

class RestHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
    var mImageView:ImageView = itemView.findViewById(R.id.imageIv)
    var mTitle: TextView=itemView.findViewById(R.id.titleTv)
    var mDes: TextView=itemView.findViewById(R.id.descriptionTv)
    var mBtn: Button = itemView.findViewById(R.id.rest_button)

}