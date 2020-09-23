using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public static class DataSystem
{
    public static void resetNewLevel(int currentLevel)
    {
        DataStorage.setCurrentLevel(currentLevel);
        DataStorage.setCurrentNounCount(0);
        DataStorage.setTimeLeft(0);
        DataStorage.setScorePoint(0);
        DataStorage.setSelectedNounTag("");
        DataStorage.setSelectedNounObject("");

        Debug.Log(string.Format("Reset with new level {0}.", currentLevel));
    }

    public static void scoreUp(int increment)
    {
        DataStorage.setScorePoint(DataStorage.getScorePoint() + increment);
    }

    public static void scoreDown(int decrement)
    {
        int scorePoint = DataStorage.getScorePoint() - decrement;
        if (scorePoint < 0)
        {
            scorePoint = 0;
        }
        DataStorage.setScorePoint(scorePoint);
    }

    public static void saveTimeLeft(float time)
    {
        DataStorage.setTimeLeft(time);
    }

    public static void saveHighestLevel(int level)
    {
        int highest_level = DataStorage.getHighestLevel();
        if (level > highest_level)
        {
            DataStorage.setHighestLevel(level);
        }
    }

    public static void resetDefault()
    {
        resetNewLevel(0);
        Debug.Log(string.Format("Reset by default all 0."));
    }

    public static void onResize()
    {
        // game window resize when browser window resize : keep same ratio
        float ratio = DataStorage.getScreenRatio();
        int browserWidth = DataStorage.getScreenWidth();
        int browserHeight = DataStorage.getScreenHeight();

        if (browserHeight * ratio > browserWidth)
        {
            browserHeight = Mathf.Min(browserHeight, Mathf.CeilToInt(browserWidth / ratio));
        }
        browserWidth = Mathf.FloorToInt(browserHeight * ratio);

        Screen.SetResolution(browserWidth, browserHeight, false);
        return;
    }

    public static int calculateTotalScore(int timeLeft, int scorePoint, int timePerScore)
    {
        int total = scorePoint + Mathf.RoundToInt(timeLeft / timePerScore);
        return total;
    }

    public static int calculateNounPercentage(int totalNounCount, int scorePoint, int scorePerNoun)
    {
        int percentage = Mathf.RoundToInt(((scorePoint / scorePerNoun) / totalNounCount) * 100);
        return percentage;
    }
}
