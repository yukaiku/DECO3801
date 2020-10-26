using System.Collections;
using System.Collections.Generic;
using UnityEngine;

/*
 * This C# class file is used for handing data acrossing the whole game and 
 * providing functionalities for game objects to make changes on data.
 * 
 */
public static class DataSystem
{
    public static void resetNewLevel(int currentLevel)
    {
        DataStorage.setCurrentLevel(currentLevel);
        DataStorage.setCurrentNounCount(0);
        DataStorage.setTimeUsed(0);
        DataStorage.setTimeLeft(0);
        DataStorage.setScorePoint(0);
        DataStorage.setNounsClicked("");
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

    public static void saveHighestLevel(int level)
    {
        int highest_level = DataStorage.getHighestLevel();
        if (level > highest_level)
        {
            DataStorage.setHighestLevel(level);
        }
    }

    public static void saveNounsClicked(string noun)
    {
        if (noun == null || noun == "")
            return;

        // uses "|" as the separator to store nouns
        string nounList = DataStorage.getNounsClicked();
        if (nounList == "")
        {
            nounList = noun;
        }
        else
        {
            nounList = nounList + "|" + noun;
        }
        DataStorage.setNounsClicked(nounList);
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
        int percentage = Mathf.RoundToInt(((float)(scorePoint / scorePerNoun) / totalNounCount) * 100);
        Debug.Log(string.Format("In total '{0}' percentage completion in this level", percentage));
        return percentage;
    }
}
