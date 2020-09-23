using System.Collections;
using System.Collections.Generic;
using UnityEngine;

// Only involve basice set/get functions
public class DataStorage
{
    /*** Game Data ***/
    static private int screenWidth = Screen.width;
    static private int screenHeight = Screen.height;
    static private float screenRatio = screenWidth / screenHeight;
    static private int gameId;
    static private int currentLevel;
    static private int currentNounCount;
    static private int timePerScore = 5;
    static private int scorePerNoun = 1;

    // the feature variables for player manual match (if implements)
    static private string selectedNounTag = "";
    static private string selectedNounObject = "";

    /*** Player Data ***/
    static private int playerId;
    static private int highestLevel;
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

    public static void setScreenRatio(float ratio)
    {
        // ratio = width : height
        screenRatio = ratio;
    }

    public static void setGameId(int id)
    {
        gameId = id;
    }

    public static void setCurrentLevel(int level)
    {
        currentLevel = level;
        Debug.Log(string.Format("PlayerData current Level '{0}'", currentLevel));
    }

    public static void setPlayerId(int id)
    {
        playerId = id;
        Debug.Log(string.Format("PlayerData player id '{0}'", playerId));
    }

    public static void setHighestLevel(int level)
    {
        highestLevel = level;
        Debug.Log(string.Format("PlayerData current highest Level '{0}'", highestLevel));
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

    public static void setTimePerScore(int times)
    {
        timePerScore = times;
    }

    public static void setScorePerNoun(int scores)
    {
        scorePerNoun = scores;
    }

    public static void setCurrentNounCount(int count)
    {
        currentNounCount = count;
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

    public static float getScreenRatio()
    {
        return screenRatio;
    }

    public static int getGameId()
    {
        return gameId;
    }

    public static int getCurrentLevel()
    {
        return currentLevel;
    }

    public static int getPlayerId()
    {
        return playerId;
    }

    public static int getHighestLevel()
    {
        return highestLevel;
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

    public static int getTimePerScore()
    {
        return timePerScore;
    }

    public static int getScorePerNoun()
    {
        return scorePerNoun;
    }

    public static int getCurrentNounCount()
    {
        return currentNounCount;
    }
}
