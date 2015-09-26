package com.copyright.router.dbUtils;

/**
 * Created by Mrsunnybunny on 9/10/2015.
 */
public class DbController {
    public static final String DB_NAME = "router.db";
    public static final int DB_VERSION = 1;

    public DbController(){}

    //for the route table
    public static final String TABLE_ROUTE = "route";
    public static final String COLUMN_ROUTE_ID = "route_id";
    public static final String COLUMN_ROUTE_CODE = "route_code";
    public static final String COLUMN_MINFARE = "minfare";
    public static final String COLUMN_INC_PER_KM = "inc_per_km";
    public static final String COLUMN_DISCOUNT = "discount";
    public static final String COLUMN_PASSAGE_WAY = "passage_way";

    //for the point table
    public static final String TABLE_POINT = "point";
    public static final String COLUMN_ID = "id";
    public static final String COLUMN_LONGITUDE_POINT = "longitude";
    public static final String COLUMN_LATITUDE_POINT = "latitude";
    public static final String COLUMN_ROUTE_ID_POINT = "route_id";
    public static final String COLUMN_CARDINAL_VALUE = "cardinal_value";

    //for the location table
    public static final String TABLE_LOCATION = "location";
    public static final String COLUMN_LOCATION_ID = "location_id";
    public static final String COLUMN_NAME = "name";
    public static final String COLUMN_LONGITUDE = "longitude";
    public static final String COLUMN_LATITUDE = "latitude";
    public static final String COLUMN_DESCRIPTION = "description";

    //for the history table
    public static final String TABLE_HISTORY = "history";
    public static final String COLUMN_HISTORY_ID = "history_id";
    public static final String COLUMN_LOCATION_ID_SOURCE = "location_id_source";
    public static final String COLUMN_LOCATION_ID_TARGET = "location_id_target";
    public static final String COLUMN_DATE_CREATED = "data_created";

    //SQL query for route table
    public static final String CREATE_ROUTE ="CREATE TABLE "
            + TABLE_ROUTE + "(" + COLUMN_ROUTE_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + COLUMN_ROUTE_CODE
            + " TEXT," + COLUMN_MINFARE +" INTEGER," + COLUMN_INC_PER_KM + "INTEGER," + COLUMN_DISCOUNT + "INTEGER"
            + COLUMN_PASSAGE_WAY + " TEXT)";

    //SQL query for point table
    public static final String CREATE_POINT ="CREATE TABLE "
            + TABLE_POINT + "(" + COLUMN_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + COLUMN_LONGITUDE_POINT
            + " INTEGER," + COLUMN_LATITUDE_POINT +" INTEGER," + COLUMN_INC_PER_KM + "INTEGER," + COLUMN_ROUTE_ID_POINT + "INTEGER"
            + COLUMN_CARDINAL_VALUE + " INTEGER, FOREIGN KEY("+ COLUMN_ROUTE_ID_POINT +") REFERENCE "+ TABLE_ROUTE +"("+ COLUMN_ROUTE_ID +"))";

    //SQL query for location table
    public static final String CREATE_LOCATION ="CREATE TABLE "
            + TABLE_LOCATION + "(" + COLUMN_LOCATION_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + COLUMN_NAME
            + " TEXT," + COLUMN_LONGITUDE +" INTEGER," + COLUMN_LATITUDE + "INTEGER," + COLUMN_DESCRIPTION + "TEXT)";

    //SQL query for history table
    public static final String CREATE_HISTORY ="CREATE TABLE "
            + TABLE_HISTORY + "(" + COLUMN_HISTORY_ID + " INTEGER PRIMARY KEY AUTOINCREMENT," + COLUMN_LOCATION_ID_SOURCE
            + " TEXT," + COLUMN_LOCATION_ID_TARGET +" TEXT," + COLUMN_DATE_CREATED + "DATE, FOREIGN KEY("+ COLUMN_LOCATION_ID_SOURCE +") REFERENCE "+ TABLE_LOCATION +"("+ COLUMN_LOCATION_ID +"), FOREIGN KEY("+ COLUMN_LOCATION_ID_TARGET +") REFERENCE "+ TABLE_LOCATION +"("+ COLUMN_LOCATION_ID +"))";

}
