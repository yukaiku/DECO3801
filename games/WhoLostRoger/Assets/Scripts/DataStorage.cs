using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class DataStorage
{
    // Game Data
    static private int currentLevel;

    // Player Data
    static private float timeLeft;
    static private int scorePoint;

    /* ********************************************************************************* *
     * ************************* FUNCTIONS ARE SITUATED BELOW ************************** *
     * ********************************************************************************* */

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
}
