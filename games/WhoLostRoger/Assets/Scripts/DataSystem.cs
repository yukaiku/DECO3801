using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public static class DataSystem
{
    public static void resetNewLevel(int currentLevel)
    {
        DataStorage.setCurrentLevel(currentLevel);
        DataStorage.setTimeLeft(0);
        DataStorage.setScorePoint(0);
        DataStorage.setSelectedNounTag("");
        DataStorage.setSelectedNounObject("");

        Debug.Log(string.Format("Reset with new level."));
    }

    public static void scoreUp(int increment)
    {
        DataStorage.setScorePoint(DataStorage.getScorePoint() + increment);
    }

    public static void saveTimeLeft(float time)
    {
        DataStorage.setTimeLeft(time);
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

    public static void sendToServer()
    {
        return;
    }

    public static void getFromServer()
    {
        return;
    }
}
