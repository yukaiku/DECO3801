using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerData
{
    static private int currentLevel;
    static private float timeLeft;
    static private int scorePoint;

    public static void saveLevel(int level)
    {
        currentLevel = level;
        Debug.Log(string.Format("PlayerData current Level '{0}'", currentLevel));
    }

    public static void saveTime(float time)
    {
        timeLeft = time;
        Debug.Log(string.Format("PlayerData time left '{0}'", timeLeft));
    }

    public static void saveScore(int score)
    {
        scorePoint = score;
        Debug.Log(string.Format("PlayerData score '{0}'", scorePoint));
    }

    public static int getLevel()
    {
        return currentLevel;
    }

    public static float getTime()
    {
        return timeLeft;
    }

    public static int getScore()
    {
        return scorePoint;
    }
}
