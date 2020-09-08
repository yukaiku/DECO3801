using System.Collections;
using System.Collections.Generic;
using UnityEngine;

// Only involve basice set/get functions
public class DataStorage
{
    /*** Game Data ***/
    static private int screenWidth = Screen.width;
    static private int screenHeight = Screen.height;
    static private int currentLevel;

    // the feature variables for player manual match (if implements)
    static private string selectedNounTag = "";
    static private string selectedNounObject = "";

    /*** Player Data ***/
    static private float timeLeft;
    static private int scorePoint;

    /* ********************************************************************************* *
     * ************************* FUNCTIONS ARE SITUATED BELOW ************************** *
     * ********************************************************************************* */

    public static void setScreenWidth(int width)
    {
        screenWidth = width;
    }

    public static void setScreenHeight(int height)
    {
        screenHeight = height;
    }

    public static void setCurrentLevel(int level)
    {
        currentLevel = level;
        Debug.Log(string.Format("PlayerData current Level '{0}'", currentLevel));
    }

    public static void setTimeLeft(float time)
    {
        timeLeft = time;
        Debug.Log(string.Format("PlayerData time left '{0}'", timeLeft));
    }

    public static void setScorePoint(int score)
    {
        scorePoint = score;
        Debug.Log(string.Format("PlayerData score '{0}'", scorePoint));
    }

    public static void setSelectedNounTag(string nounName)
    {
        selectedNounTag = nounName;
        Debug.Log(string.Format("Player select the noun tag '{0}'", selectedNounTag));
    }

    public static void setSelectedNounObject(string nounName)
    {
        selectedNounObject = nounName;
        Debug.Log(string.Format("Player select the noun object '{0}'", selectedNounObject));
    }

    /************************************ Divider ************************************/

    public static int getScreenWidth()
    {
        return screenWidth;
    }

    public static int getScreenHeight()
    {
        return screenHeight;
    }

    public static int getCurrentLevel()
    {
        return currentLevel;
    }

    public static float getTimeLeft()
    {
        return timeLeft;
    }

    public static int getScorePoint()
    {
        return scorePoint;
    }

    public static string getSelectedNounTag()
    {
        return selectedNounTag;
    }

    public static string getSelectedNounObject()
    {
        return selectedNounObject;
    }
}
